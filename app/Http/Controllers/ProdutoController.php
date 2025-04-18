<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cart;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class ProdutoController extends Controller
{
    /* public function index()
    {
        $produtos = Produto::all(); 
        if ($produtos) {
            $user = Auth::user();
            if ($user) {
                $carrinho = Cart::where('user_id', $user->id)->get();
                $total_items = $carrinho->count(); 
                $total = $carrinho->reduce(function ($carry, $item) {
                    return $carry + ($item->price * $item->quantity);
                }, 0);
                return view('index', compact('produtos', 'carrinho', 'total', 'total_items'));
            }
    
            return view('index', compact('produtos'));
        }
    
        return response()->json(['error' => 'Produto não encontrado'], 404);
    } */

    public function index()
    {
         // Filtrar produtos pelas categorias especificadas, exceto o com id 83
        $produtosPerfumes = Produto::where('categoria', 'Perfumes')->where('id', '!=', 83)->get();
        //$produtosPerfumes = Produto::where('categoria', 'Perfumes')->get();
        $produtosBodySplash = Produto::where('categoria', 'Body splash')->get();
        $produtosHidratantes = Produto::where('categoria', 'Hidratantes')->get();

        // Verificar se há produtos retornados
        if ($produtosPerfumes->isNotEmpty() || $produtosBodySplash->isNotEmpty() || $produtosHidratantes->isNotEmpty()) {
            $user = Auth::user();

            if ($user) {
                $carrinho = Cart::where('user_id', $user->id)->get();
                $total_items = $carrinho->count(); // Conta o número total de itens únicos no carrinho
                $total = $carrinho->reduce(function ($carry, $item) {
                    return $carry + ($item->price * $item->quantity);
                }, 0);

                return view('index', compact('produtosPerfumes', 'produtosBodySplash', 'produtosHidratantes', 'carrinho', 'total', 'total_items'));
            }

            return view('index', compact('produtosPerfumes', 'produtosBodySplash', 'produtosHidratantes'));
        }

        return response()->json(['error' => 'Produto não encontrado'], 404);
    }

    /* Função responsavel pela busca no cabeçalho */
    public function busca(Request $request)
    {
        $query = $request->input('query');

        // Buscar todos os produtos com base no nome
        $produtos = Produto::where('nome', 'like', '%' . $query . '%')->get();

        // Buscar produtos por categorias
        $produtosPerfumes = Produto::where('categoria', 'Perfumes')->get();
        $produtosBodySplash = Produto::where('categoria', 'Body Splash')->get();
        $produtosHidratantes = Produto::where('categoria', 'Hidratantes')->get();

        // Verificar se o usuário está logado para informações do carrinho
        $user = Auth::user();
        if ($user) {
            $carrinho = Cart::where('user_id', $user->id)->get();
            $total_items = $carrinho->count();
            $total = $carrinho->reduce(function ($carry, $item) {
                return $carry + ($item->price * $item->quantity);
            }, 0);

            // Redireciona para a view index com os produtos filtrados e as categorias
            return view('index', compact('produtos', 'produtosPerfumes', 'produtosBodySplash', 'produtosHidratantes', 'carrinho', 'total', 'total_items'));
        }

        // Se o usuário não estiver logado, retornar sem carrinho
        return view('index', compact('produtos', 'produtosPerfumes', 'produtosBodySplash', 'produtosHidratantes'));
    }




    public function show($id)
    {
        $produto = Produto::find($id);
        $todos_produtos = Produto::all(); // Busca todos os produtos do banco de dados

        if ($produto) {

            ///////////////////

            /*if ($id == 31) { // Substitua 48 pelo ID do seu produto promocional
                $preco_promocional = 66.90; // Define o preço promocional
                $produto->preco_promocional= $preco_promocional;
               
            } */
            ///////////////////

            $user = Auth::user();
            if ($user) {
                $carrinho = Cart::where('user_id', $user->id)->get();
                $total_items = $carrinho->count(); // Conta o número total de itens únicos no carrinho
                $total = $carrinho->reduce(function ($carry, $item) {
                    return $carry + ($item->price * $item->quantity);
                }, 0);
                return view('product-details-v1', compact('produto', 'todos_produtos', 'carrinho', 'total', 'total_items'));
            }


            return view('product-details-v1', compact('produto', 'todos_produtos'));
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

        // Inicializar variáveis de categorias para evitar erro de variável indefinida
        $produtosPerfumes = collect();
        $produtosBodySplash = collect();
        $produtosHidratantes = collect();

        // Buscar produtos com base na categoria fornecida
        if ($categoria) {
            $produtos = Produto::where('categoria', $categoria)->get();

            // Se for a categoria "Perfumes", atribuir os produtos à variável correta
            if ($categoria == 'Perfumes') {
                $produtosPerfumes = $produtos;
            } elseif ($categoria == 'Body splash') {
                $produtosBodySplash = $produtos;
            } elseif ($categoria == 'Hidratantes') {
                $produtosHidratantes = $produtos;
            }

            // Se nenhum produto for encontrado, buscar todos os produtos
            if ($produtos->isEmpty()) {
                $produtosPerfumes = Produto::all();
                $categoria = null; // Remover a categoria do filtro quando retornar todos os produtos
            }
        }

        // Retornar a view index com os produtos encontrados e as variáveis adequadas
        return view('index', compact('produtosPerfumes', 'produtosBodySplash', 'produtosHidratantes', 'categoria', 'scrollTo'));
    }


    /* Funçao para adicionar itens ao carrinho e depois abrir carrinho de compras se der tudo certo
     */
    public function adicionar(Request $request)
    {
        // Validação básica
        $validated = $request->validate([
            'quantidade' => 'required|integer|min:1',
            'produto_id' => 'required|exists:produtos,id',
        ]);

        // Obtendo o usuário logado
        $user = auth()->user();

        if (!$user) {
            // Se o usuário não estiver logado, retornar um erro para redirecionar para a página de login
            return response()->json([
                'success' => false,
                'redirect' => route('login') // URL de redirecionamento para a página de login
            ], 401); // Status 401 Unauthorized
        }

        // Lógica para adicionar ao carrinho
        Cart::create([
            'product_id' => $validated['produto_id'],
            'quantity' => $validated['quantidade'],
            'user_id' => $user->id,
            'price' => Produto::find($validated['produto_id'])->preco_promocional,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }


    public function remove($id)
    {
        $user = Auth::user();
        if ($user) {
            // Remover item do carrinho
            Cart::where('id', $id)->where('user_id', $user->id)->delete();

            // Retornar resposta para atualização do front-end
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Não autorizado'], 403);
    }






}
