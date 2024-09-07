<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cart;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all(); // Busca todos os produtos do banco de dados
        return view('index', compact('produtos')); // Passa a variável $produtos para a view
    }

    public function busca(Request $request)
    {
        $query = $request->input('query');
        $produtos = Produto::where('nome', 'like', '%' . $query . '%')->get();

        // Redireciona para a view index com os produtos filtrados
        return view('index', compact('produtos'));
    }

    /* public function getProdutoById($id)
    {
        $produto = Produto::findOrFail($id);

        return response()->json($produto);
    } */



    public function show($id)
    {
        $produto = Produto::find($id);
        $todos_produtos = Produto::all(); // Busca todos os produtos do banco de dados
    
        if ($produto) {
            /* return response()->json([
                'imagem' => $produto->imagem,
                'nome' => $produto->nome,
                'preco_antigo' => $produto->preco_antigo,
                'preco_atual' => $produto->preco_atual,
                'desconto' => $produto->desconto,
                'avaliacao' => $produto->avaliacao,
                'avaliacoes_count' => $produto->avaliacoes_count,
                'descricao' => $produto->descricao,
                'visualizacoes' => $produto->visualizacoes,
                'estoque' => $produto->estoque,
                'estoque_percent' => $produto->estoque_percent,
                'data_entrega' => $produto->data_entrega,
                'sku' => $produto->sku,
                'categoria' => $produto->categoria,
                'tags' => $produto->tags,
                'imagens_adicionais' => $produto->imagens_adicionais, // Assumindo que isso seja um array de strings (caminhos das imagens)
            ]); */

            return view('product-details-v1', compact('produto','todos_produtos'));
        }
    
        return response()->json(['error' => 'Produto não encontrado'], 404);
    }
    

    //view de cadastro de produtos
    public function create()
    {
        // Aqui você pode passar dados adicionais para a view, se necessário
        return view('produtos.create');
    }

    //função de cadastro de produto ao clicar em cadastrar
    public function store(Request $request)
{
    // Validação dos dados
    $validatedData = $request->validate([
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string',
        'preco' => 'required|numeric',
        'preco_promocional' => 'nullable|numeric',
        'quantidade_estoque' => 'required|integer',
        'categoria' => 'required|string',
        'ativo' => 'nullable|boolean',
        'tags' => 'nullable|string',
        'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:700',
        'imagens_adicionais.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'modo_de_usar' => 'nullable|string',
        'caracteristicas' => 'nullable|string', // O campo "caracteristicas" será salvo como JSON
    ]);

    // Criação do produto
    $produto = new Produto();
    $produto->nome = $validatedData['nome'];
    $produto->descricao = $validatedData['descricao'];
    $produto->preco = $validatedData['preco'];
    $produto->preco_promocional = $validatedData['preco_promocional'];
    $produto->quantidade_estoque = $validatedData['quantidade_estoque'];
    $produto->categoria = $validatedData['categoria'];
    $produto->ativo = 1;
    $produto->tags = 2024;
    $produto->modo_de_usar = $validatedData['modo_de_usar'];
    $produto->caracteristicas = $validatedData['caracteristicas'];
//    $produto->caracteristicas = json_encode(explode(',', $validatedData['caracteristicas'])); // Transformando a string de características em um array JSON
 
//dd($produto->caracteristicas);
    // Upload da imagem principal
    if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
        $requestImage = $request->imagem;
        $extension = $requestImage->extension();
        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

        // Redimensionar a imagem principal
        $image = Image::make($requestImage->getRealPath());
        $image->resize(540, 720)->save(public_path('images/products/' . $imageName));

        $produto->imagem = $imageName;
    }

    // Upload das imagens adicionais
    if ($request->hasFile('imagens_adicionais')) {
        $imageNames = [];
        foreach ($request->file('imagens_adicionais') as $image) {
            if ($image->isValid()) {
                $extension = $image->extension();
                $imageName = md5($image->getClientOriginalName() . strtotime("now")) . "." . $extension;

                // Redimensionar as imagens adicionais
                $imageResized = Image::make($image->getRealPath());
                $imageResized->resize(540, 720)->save(public_path('images/products/' . $imageName));

                $imageNames[] = $imageName;
            }
        }
        $produto->imagens_adicionais = json_encode($imageNames);
    }

    // Salvamento do produto
    $produto->save();
    
    return back()->with('success', 'Produto cadastrado com sucesso!');
}

    


    public function buscarPorCategoria(Request $request)
    {
        // Obter o parâmetro de categoria, se existir
        $categoria = $request->query('categoria');
        $scrollTo = $request->query('scroll_to', ''); // 'scroll_to' é opcional
    
        // Buscar produtos com base na categoria, se fornecida
        if ($categoria) {
            // Buscar produtos na categoria especificada
            $produtos = Produto::where('categoria', $categoria)->get();
    
            // Se nenhum produto for encontrado, buscar todos os produtos
            if ($produtos->isEmpty()) {
                $produtos = Produto::all();
                $categoria = null; // Remover a categoria do filtro quando retornar todos os produtos
            }
        } else {
            // Se a categoria não for fornecida, retornar todos os produtos
            $produtos = Produto::all();
        }
    
        // Retornar a view index com os produtos encontrados
        return view('index', compact('produtos', 'categoria', 'scrollTo'));
    }


    public function adicionar(Request $request)
    {
        // Validação básica
        $validated = $request->validate([
            'quantidade' => 'required|integer|min:1',
            'produto_id' => 'required|exists:produtos,id',
        ]);
    
        // Obtendo o usuário logado
        $user = auth()->user();
    
        // Lógica para adicionar ao carrinho
        Cart::create([
            'product_id' => $validated['produto_id'], // Nome correto do campo
            'quantity' => $validated['quantidade'],  // Nome correto do campo
            'user_id' => $user->id,
            'price' => Produto::find($validated['produto_id'])->preco_promocional, // Exemplo para definir o preço
        ]);
    
        return response()->json([
            'success' => true,
            'carrinho' => 'carrinhoAtualizado',
        ]);
    }
    
    
    
     
 
 

    
    
}
