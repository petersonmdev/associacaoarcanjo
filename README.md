
# Sistema de Gestão de Associação para Assistência a Famílias Carentes

## Descrição

Este é um sistema desenvolvido utilizando o framework Laravel versão 10 para auxiliar na gestão de uma associação que atende famílias carentes por meio da distribuição de cestas básicas e outros recursos. O sistema foi projetado para oferecer funcionalidades abrangentes para gerenciar todas as operações relacionadas à assistência prestada pela associação.

## Funcionalidades Principais
### Gestão de famílias assistidas:

Registro detalhado de famílias que recebem assistência da associação, incluindo informações como composição familiar, situação socioeconômica, necessidades especiais, entre outros.

### gestão de Voluntários:

Registros de voluntários que colaboram com a associação, incluindo suas informações pessoais, habilidades, disponibilidade e histórico de atividades.

### Gestão de Remessas de Cestas Básicas:

Controle completo das remessas de cestas básicas, desde o recebimento até a distribuição às famílias assistidas, incluindo informações sobre a quantidade de cestas, datas de envio e recebimento, entre outros.

### Gestão de Doações:

Monitoramento de todas as doações recebidas pela associação, seja em dinheiro, alimentos, roupas ou outros recursos, incluindo detalhes como doador, data, tipo e quantidade da doação.

### Entregas e Recebimentos de Doações:

Registro das entregas de doações às famílias assistidas, garantindo transparência e rastreabilidade no processo de distribuição, assim como o registro do recebimento de doações pela associação.

### Gestão de Bazar:

Controle das atividades relacionadas ao bazar da associação, incluindo o recebimento de itens doados, organização do estoque, vendas e registros financeiros.

## Objetivo
O principal objetivo deste sistema é proporcionar uma ferramenta eficiente para facilitar a gestão operacional e administrativa da associação que atua na assistência a famílias carentes. Ao centralizar todas as informações e processos em uma plataforma digital, o sistema busca otimizar o tempo e os recursos da associação, permitindo uma melhor organização, acompanhamento e tomada de decisões.

Com uma interface intuitiva e funcionalidades abrangentes, o sistema visa melhorar a eficiência e a transparência das operações da associação, garantindo um atendimento mais eficaz e uma prestação de contas detalhada aos doadores, voluntários e demais partes interessadas.

## Requisitos de Instalação
Para instalar e executar este sistema, é necessário cumprir os seguintes requisitos:

- `PHP >= 8.0`
- `Banco de Dados MySQL ou PostgreSQL`
- `Composer instalado globalmente`
- `Node.js e npm (para gerenciamento de assets)`
- `Git`

## Instalação
1- Clone o repositório do projeto para sua máquina local:
```bash
  git clone https://github.com/petersonmdev/associacaoarcanjo.git
```

2- Acesse o diretório do projeto:
```bash
  cd nome-do-repositorio
```

3- Instale as dependências do PHP usando o Composer:
```bash
  composer install
```

4- Instale as dependências de frontend usando o npm:
```bash
  npm run build
```

5- Copie o arquivo .env.example e renomeie para .env. Em seguida, configure as variáveis de ambiente, incluindo a conexão com o banco de dados.

6- Gere uma nova chave de aplicativo Laravel:

```bash
  php artisan key:generate
```

7- Execute as migrações do banco de dados para criar as tabelas necessárias:
```bash
  php artisan migrate
```

8- Inicie o servidor de desenvolvimento:
```bash
  php artisan serve
```

9- Acesse o sistema em seu navegador, utilizando o URL fornecido pelo servidor de desenvolvimento.

## Stack utilizada

**Front-end:** Livewire, TailwindCSS

**Back-end:** PHP com Framework Laravel

**Banco de dados:** Mysql

## Licença
Este sistema é distribuído sob a licença MIT. Consulte o arquivo LICENSE para obter mais informações.

## Autor
- [Github] [github/petersonmdev](https://www.github.com/petersonmdev)
- [Email] [petersondmb@gmail.com](mailto:petersondmb@gmail.com)

![Logo](https://petersonmacedo.com.br/site/assets/img/gallery/logo-old.png)

## Suporte
Para suporte, mande um email para petersondmb@gmail.com.

## Usado por

Esse projeto é usado pelas seguintes empresas:

- Associação ARCanjo

