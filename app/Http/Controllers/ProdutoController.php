<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all(); // Busca todos os produtos do banco de dados
        return view('index', compact('produtos')); // Passa a variável $produtos para a view
    }

    public function getProdutoById($id)
    {
        // Busca o produto pelo ID, retornando erro 404 caso não seja encontrado
        $produto = Produto::findOrFail($id);

        // Retorna o produto em formato JSON
        return response()->json($produto);
    }

    public function show($id)
    {
        $produto = Produto::find($id);
    
        if ($produto) {
            return response()->json([
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
            ]);
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
        'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //'imagens_adicionais.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    // Criação do produto
    $produto = new Produto();
    $produto->nome = $validatedData['nome'];
    $produto->descricao = $validatedData['descricao'];
    $produto->preco = $validatedData['preco'];
    $produto->preco_promocional = $validatedData['preco_promocional'];
    $produto->quantidade_estoque = $validatedData['quantidade_estoque'];
    $produto->categoria = $validatedData['categoria'];
    $produto->ativo = $validatedData['ativo'];
    $produto->tags = $validatedData['tags'];

    // Upload da imagem principal
    if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
        $requestImage = $request->imagem;
        $extension = $requestImage->extension();
        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
        $requestImage->move(public_path('images/products'), $imageName);
        $produto->imagem = $imageName;
    }

    // Upload das imagens adicionais
    if ($request->hasFile('imagens_adicionais')) {
        $imageNames = [];
        foreach ($request->file('imagens_adicionais') as $image) {
            if ($image->isValid()) {
                $extension = $image->extension();
                $imageName = md5($image->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $image->move(public_path('images/products'), $imageName);
                $imageNames[] = $imageName;
            }
        }
        $produto->imagens_adicionais = json_encode($imageNames); // Salvar como JSON se precisar
    }

    // Salvamento do produto
    $produto->save();
        return back()->with('success', 'Produto cadastrado com sucesso!');
    
/*         return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
 */    }


/* public function saveProductInfo(Request $request)
 {
     $id = $request->input('id');
    
     $produto = Produto::find($id);
        
     if ($produto) {
        $productData = [
            'id' => $produto->id,
            'nome' => $produto->nome,
            'descricao' => $produto->descricao,
            'preco' => $produto->preco,
            'preco_promocional' => $produto->preco_promocional,
            'imagem' => $produto->imagem,
        ];

         return response()->json(['success' => true, 'produto' => $productData]);
     } else {
         return response()->json(['success' => false, 'message' => 'Produto não encontrado.']);
     }
 } */
 
 

    
    
}
