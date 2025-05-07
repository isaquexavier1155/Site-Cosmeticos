<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mensagens de Validação Padrão
    |--------------------------------------------------------------------------
    |
    | As mensagens de validação abaixo são usadas pela classe de validação do
    | Laravel. Algumas dessas regras têm mensagens que são padronizadas pelo
    | Laravel, mas você pode substituir as mensagens padrão abaixo.
    |
    */

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute deve ser uma data após :date.',
    'after_or_equal'       => 'O campo :attribute deve ser uma data igual ou posterior a :date.',
    'alpha'                => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute deve conter apenas letras, números, traços e underscores.',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números.',
    'array'                => 'O campo :attribute deve ser um array.',
    'before'               => 'O campo :attribute deve ser uma data antes de :date.',
    'before_or_equal'      => 'O campo :attribute deve ser uma data igual ou anterior a :date.',
    'between'              => [
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'file'    => 'O campo :attribute deve ter entre :min e :max kilobytes.',
        'string'  => 'O campo :attribute deve ter entre :min e :max caracteres.',
        'array'   => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não corresponde.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_equals'          => 'O campo :attribute deve ser uma data igual a :date.',
    'date_format'          => 'O campo :attribute deve corresponder ao formato :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O campo :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute contém um valor duplicado.',
    'email'                => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'ends_with'            => 'O campo :attribute deve terminar com um dos seguintes valores: :values.',
    'exists'               => 'O campo :attribute selecionado é inválido.',
    'file'                 => 'O campo :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve ter um valor.',
    'gt'                   => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file'    => 'O campo :attribute deve ser maior que :value kilobytes.',
        'string'  => 'O campo :attribute deve ter mais de :value caracteres.',
        'array'   => 'O campo :attribute deve ter mais de :value itens.',
    ],
    'gte'                  => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file'    => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
        'string'  => 'O campo :attribute deve ter :value ou mais caracteres.',
        'array'   => 'O campo :attribute deve ter :value itens ou mais.',
    ],
    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O campo :attribute selecionado é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute deve ser um número inteiro.',
    'ip'                   => 'O campo :attribute deve ser um endereço de IP válido.',
    'ipv4'                 => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O campo :attribute deve ser uma string JSON válida.',
    'lt'                   => [
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'file'    => 'O campo :attribute deve ser menor que :value kilobytes.',
        'string'  => 'O campo :attribute deve ter menos de :value caracteres.',
        'array'   => 'O campo :attribute deve ter menos de :value itens.',
    ],
    'lte'                  => [
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'file'    => 'O campo :attribute deve ser menor ou igual a :value kilobytes.',
        'string'  => 'O campo :attribute deve ter :value ou menos caracteres.',
        'array'   => 'O campo :attribute não deve ter mais de :value itens.',
    ],
    'max'                  => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file'    => 'O campo :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O campo :attribute não pode ter mais que :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'file'    => 'O campo :attribute deve ter no mínimo :min kilobytes.',
        'string'  => 'O campo :attribute deve ter no mínimo :min caracteres.',
        'array'   => 'O campo :attribute deve ter no mínimo :min itens.',
    ],
    'not_in'               => 'O campo :attribute selecionado é inválido.',
    'not_regex'            => 'O formato do campo :attribute é inválido.',
    'numeric'              => 'O campo :attribute deve ser um número.',
    'password'             => [
        'letters' => 'O campo :attribute deve conter pelo menos uma letra.',
        'mixed'   => 'O campo :attribute deve conter pelo menos uma letra maiúscula e uma minúscula.',
        'numbers' => 'O campo :attribute deve conter pelo menos um número.',
        'symbols' => 'O campo :attribute deve conter pelo menos um símbolo.',
    ],
    'present'              => 'O campo :attribute deve estar presente.',
    'prohibited'           => 'O campo :attribute é proibido.',
    'prohibited_if'        => 'O campo :attribute é proibido quando :other for :value.',
    'prohibited_unless'    => 'O campo :attribute é proibido, a menos que :other seja :value.',
    'regex'                => 'O formato do campo :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other for :value.',
    'required_unless'      => 'O campo :attribute é obrigatório, a menos que :other seja :value.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values estiver presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estiverem presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não estiver presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estiver presente.',
    'same'                 => 'Os campos :attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => 'O campo :attribute deve ser :size.',
        'file'    => 'O campo :attribute deve ter :size kilobytes.',
        'string'  => 'O campo :attribute deve ter :size caracteres.',
        'array'   => 'O campo :attribute deve conter :size itens.',
    ],
    'starts_with'          => 'O campo :attribute deve começar com um dos seguintes valores: :values.',
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve ser uma zona válida.',
    'unique' => 'O campo :attribute já está em uso.',
    'uploaded'             => 'O campo :attribute falhou ao fazer o upload.',
    'url'                  => 'O campo :attribute deve ser uma URL válida.',
    'uuid'                 => 'O campo :attribute deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Atributos de Validação Personalizados
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir os nomes personalizados para atributos de validação.
    | O Laravel usa essas opções para exibir os nomes dos campos de erro.
    | Um exemplo: 'email' => 'E-mail do usuário',.
    |
    */

    'attributes' => [
        'address'               => 'endereço',
        'age'                   => 'idade',
        'amount'                => 'quantidade',
        'area'                  => 'área',
        'available'             => 'disponível',
        'birthday'              => 'data de nascimento',
        'body'                  => 'corpo',
        'city'                  => 'cidade',
        'company'               => 'empresa',
        'content'               => 'conteúdo',
        'country'               => 'país',
        'date'                  => 'data',
        'description'           => 'descrição',
        'email'                 => 'e-mail',
        'email_confirmation'    => 'confirmação de e-mail',
        'end_date'              => 'data de término',
        'first_name'            => 'primeiro nome',
        'gender'                => 'gênero',
        'last_name'             => 'sobrenome',
        'latitude'              => 'latitude',
        'longitude'             => 'longitude',
        'message'               => 'mensagem',
        'name'                  => 'nome',
        'password'              => 'senha',
        'password_confirmation' => 'confirmação de senha',
        'phone'                 => 'telefone',
        'postal_code'           => 'código postal',
        'price'                 => 'preço',
        'quantity'              => 'quantidade',
        'region'                => 'região',
        'start_date'            => 'data de início',
        'status'                => 'status',
        'title'                 => 'título',
        'updated_at'            => 'data de atualização',
        'username'              => 'nome de usuário',
        'zip_code'              => 'CEP',
    ],

];
