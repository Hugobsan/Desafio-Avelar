# 🎓 Desafio Avelar

Seja bem-vindo ao **Desafio Avelar**! 🚀  
Este repositório é a base para avaliar suas habilidades full-stack em Laravel 11 (PHP 8.2). Siga este guia para configurar o ambiente e começar.

---

## 📋 Pré-requisitos

- **PHP** ≥ 8.2  
- **Composer**  
- **MySQL**  
- **Git**  
- **Node.js + npm** (opcional, apenas se for compilar assets)

---

## 🛠️ Passo a Passo

```bash
# 1. Clonar o repositório
git clone https://github.com/Hugobsan/Desafio-Avelar.git
cd Desafio-Avelar

# 2. Instalar dependências PHP
composer install

# 3. Copiar e configurar variáveis de ambiente
cp .env.example .env
# abra .env e ajuste:
# DB_DATABASE=seu_banco
# DB_USERNAME=seu_usuario
# DB_PASSWORD=sua_senha

# 4. Gerar chave de aplicação
php artisan key:generate

# 5. Criar link simbólico para uploads
php artisan storage:link

# 6. Rodar migrations e seeders
php artisan migrate --seed

# 7. Executar servidor de desenvolvimento
php artisan serve
# abra no navegador:
# http://127.0.0.1:8000

```
## 💾 Banco de Dados
Ao rodar o comando `php artisan migrate --seed`, o banco de dados será criado automaticamente, além de popular com dados de exemplo.

## 🎯 Objetivo do Desafio
## **Front-end**
### Página única com Blade + HTML/CSS/Bootstrap/JavaScript, seja criativo e não se prenda em visuais genéricos, queremos ver seu potencial!!

#### *Formulário com:*

- Nome, Idade, CEP, Cidade, Estado, Rua, Bairro

- Possui Ensino Médio (checkbox)

- Sexo (select: Masculino, Feminino, Outro)

- Salário (máscara brasileira, ex.: 1.234,56)

- Anexo (upload de pdf/jpg/png, ≤ 10 MB)

- #### *Ao submeter, exiba todos os registros (cards, tabela, gráfico, etc.)*

- #### *Cada registro com botões Editar e Excluir (com confirmação)*

## **Back-end (CRUD sem Models/Migrations), sinta-se a vontade para usar models e migrations caso prefira, não se prenda aos comandos estipulados abaixo, nos mostre como você desenvolve um CRUD bem organizado e bem estruturado**
- Create: DB::insert() com SQL cru

- Read: DB::select() ordenado por id DESC

- Update: DB::update() via formulário preenchido

- Delete: DB::delete() com confirmação no front-end

#### **Validações:** #### *Caso queira, adicione validações de frontend e backend*

- Campos obrigatórios: nome, idade, cep, cidade, estado, rua, bairro, sexo

- Idade: inteiro positivo

- Possui Ensino médio: Checkbox

- CEP: formato 99.999-999

- Salário: numérico (converta vírgula para ponto antes de salvar 3.000,00)

- Anexo: extensões permitidas (.pdf, .jpg, .png), tamanho máximo 10 MB


## Este desafio serve como uma avaliação e complemento da entrevista, caso sinta dificuldade em algum passo ou no desenvolvimento do Desafio com o frontend e backend, deixe seu feedback!

## Caso não consiga concluir todos os passos, não deixe de enviar o projeto, iremos avaliar tudo o que foi feito por você!

<p align="center">
  <img src="https://github.githubassets.com/images/spinners/octocat-spinner-32.gif" width="32" height="32" alt="Carregando..." />
  <strong>Não se esqueça de salvar o seu projeto no seu GitHub em uma pasta pública!</strong>
  <img src="https://github.githubassets.com/images/spinners/octocat-spinner-32.gif" width="32" height="32" alt="Carregando..." />
</p>


## 🍀 Boa sorte e bons códigos!
— Time Avelar
