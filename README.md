## Visão Geral

 **Sistema de Gestão de Funcionários** foi projetado para tornar a administração de colaboradores mais eficiente e organizada. Com uma interface intuitiva e moderna, ele permite o cadastro, edição, exclusão e consulta de funcionários de maneira ágil e segura, otimizando a gestão e melhorando o fluxo de trabalho dentro da empresa.

### Principais Funcionalidades
-  Cadastro de funcionários
-  Edição de informações
-  Exclusão lógica de registros
-  Pesquisa avançada de funcionários
-  Upload de fotos
-  Validação de dados

## 🎥 Demonstração

Confira abaixo uma prévia do funcionamento do sistema:

[Demonstração do Projeto - ](assets/img/Vídeo-sem-título-‐-Feito-com-o-Clipchamp.gif)

## 💻 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

-  **PHP 8.4.4**
-  **PostgreSQL**
-  **JavaScript (jQuery e Bootstrap)**
-  **HTML/CSS**
-  **Composer**
-  **Cloudinary**

## Como Executar o Projeto

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
1. Crie uma conta gratuita em: [cloudinary.com](https://cloudinary.com/)
2. Instale o SDK do Cloudinary via Composer:
   ```bash
   composer require cloudinary/cloudinary_php
   ```
3. Configure suas credenciais no arquivo `config/config.php`

Acesse a aplicação pelo navegador:

🔗 **http://localhost/SeuServidor** (Exemplo: `http://localhost:5000`)

---

💡 *Agora você está pronto para utilizar o Sistema de Gestão de Funcionários!*

