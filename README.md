# CPF Search API - PHP

Este projeto é uma aplicação simples em PHP que consulta dados do CPF utilizando a API externa [APICPF](https://www.apicpf.com/). Ao fornecer um número de CPF, o sistema retorna informações como nome, CPF formatado, gênero e data de nascimento.

## Funcionalidade

- O usuário insere um CPF (com ou sem formatação) no campo de consulta.
- O sistema valida o CPF e consulta a API.
- Caso o CPF seja válido, exibe as informações de nome, CPF, gênero e data de nascimento.
- Em caso de erro, uma mensagem é exibida.

## Como funciona

1. O formulário coleta o número do CPF via POST.
2. O CPF é sanitizado e validado.
3. A API é chamada para obter os dados e exibi-los ao usuário.
4. Mensagens de erro ou sucesso são mostradas com base no resultado da consulta.

## Requisitos

- PHP 7.0 ou superior
- Acesso à internet para realizar a consulta à API
- Conexão com a API externa [APICPF](https://www.apicpf.com/) para obter os dados.

## Como utilizar

1. **Adicionar o Token da API:** Antes de usar, é necessário adicionar seu **API Key** pessoal fornecido pelo [APICPF](https://www.apicpf.com/).
   
   Abra o arquivo PHP e substitua o valor da variável `$apiKey` pela sua chave de API:
   ```php
   $apiKey = "SUA_API_KEY_AQUI";
   ```

2. Baixe ou clone este repositório.
3. Abra o arquivo PHP em um servidor web com suporte a PHP.
4. Acesse o aplicativo via navegador.

## Links

- [APICPF](https://www.apicpf.com/)
- [GitHub - api-cpf-php](https://github.com/psilvagg/api-cpf-php)

## Licença

Este projeto está licenciado sob a MIT License.
