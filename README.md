##  Visão Geral

O **Sistema de Gestão de Funcionários** foi projetado para tornar a administração de colaboradores mais eficiente e organizada. Com uma interface intuitiva e moderna, ele permite o cadastro, edição, exclusão e consulta de funcionários de maneira ágil e segura, otimizando a gestão e melhorando o fluxo de trabalho dentro da empresa.

###  Principais Funcionalidades
-  Cadastro de funcionários
-  Edição de informações
-  Exclusão lógica de registros
-  Pesquisa avançada de funcionários
-  Upload de fotos
-  Validação de dados

## 🎥 Demonstração

Confira abaixo uma prévia das funcionalidades presentes no sistema:

![Demonstração do Projeto](assets/img/video.gif)


## 💻 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

-  **PHP 8.4.4**
-  **PostgreSQL**
-  **JavaScript (jQuery e Bootstrap)**
-  **HTML/CSS**
-  **Composer**
-  **Cloudinary**

## ⚙️ Como Executar o Projeto

### 1️⃣ Clone o repositório:

```bash
git clone https://github.com/ezequiasangelo/Crud-Empresa
```

### 2️⃣ Configure o Banco de Dados

Crie um banco de dados chamado `crud-empresa` e execute o seguinte script SQL:

```sql
CREATE TABLE IF NOT EXISTS funcionarios (
    cpf VARCHAR(14) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    sobrenome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    cracha VARCHAR(50) UNIQUE NOT NULL,
    data_nascimento DATE NOT NULL,
    foto TEXT,
    isdeleted BOOLEAN DEFAULT FALSE
);
```

### 3️⃣ Configuração

Edite o arquivo `config/config.php` com as credenciais corretas do PostgreSQL.

### 4️⃣ Execução

Instale um servidor local (XAMPP, WAMP ou equivalente) e inicie o Apache e o PostgreSQL.

### 📥 Instalando Dependências Adicionais

Para garantir o funcionamento correto do sistema, instale o **Composer** e o **Cloudinary**:

🔹 **Instalando o Composer no Windows**
1. Baixe o instalador em: [getcomposer.org](https://getcomposer.org/download/)
2. Execute o instalador e siga as instruções na tela
3. Verifique a instalação executando o comando:
   ```bash
   composer -V
   ```

🔹 **Instalando o Cloudinary**

1. Instale o SDK do Cloudinary via Composer:
   ```bash
   composer require cloudinary/cloudinary_php
   ```
2. Configure suas credenciais no arquivo `config/config.php`

### 🔧 Configurando o `php.ini`

Para evitar problemas de compatibilidade e garantir que o PostgreSQL funcione corretamente, edite o arquivo `php.ini` e descomente ou adicione as seguintes linhas:

1. Habilite a exibição de erros, mas sem avisos de funções obsoletas:
   ```ini
   error_reporting = E_ALL & ~E_DEPRECATED
   ```
2. Ative as extensões do PostgreSQL:
   ```ini
   extension=pgsql
   extension=pdo_pgsql
   ```
3. Reinicie o servidor Apache para aplicar as alterações.

Inicie a aplicação 
   ```bash
   php -S localhost:'SEU SERVIDOR'
   ```

Acesse a aplicação pelo navegador:

🔗 **http://localhost/SeuServidor** (Exemplo: `http://localhost:5000`)

---

💡 *Agora você está pronto para utilizar o Sistema de Gestão de Funcionários!*

