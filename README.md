# Products SRP Demo

Alunos
- Felipe Meireles - RA 2012841



Projeto desenvolvido como parte do **Exercício 2 (PRD)** — Cadastro e Listagem de Produtos, aplicando o princípio **SRP (Single Responsibility Principle)** em PHP puro.

O sistema permite **cadastrar** e **listar produtos** utilizando um arquivo texto (`storage/products.txt`) como persistência, sem uso de banco de dados.

---

## 🚀 Como executar o projeto

1. Coloque a pasta `products-srp-demo` dentro do diretório do seu servidor (ex.: `C:\xampp\htdocs`).
2. Abra o terminal dentro da pasta do projeto e execute:
   ```bash
   composer dump-autoload
   ```
   Isso cria o autoload PSR-4 necessário.
3. Inicie o servidor Apache no XAMPP.
4. Acesse no navegador:
   ```
   http://localhost/products-srp-demo/public/
   ```

---

## 🧩 Estrutura do projeto

```
products-srp-demo/
├─ composer.json
├─ src/
│  ├─ Contracts/              # Interfaces (contratos)
│  │  ├─ ProductRepository.php
│  │  └─ ProductValidator.php
│  ├─ Application/            # Camada de orquestração
│  │  └─ ProductService.php
│  ├─ Domain/                 # Regras de negócio
│  │  └─ SimpleProductValidator.php
│  └─ Infra/                  # Persistência em arquivo
│     └─ FileProductRepository.php
├─ public/
│  ├─ index.php               # Formulário de cadastro
│  ├─ create.php              # Recebe POST e cadastra
│  └─ products.php            # Lista os produtos
└─ storage/
   └─ products.txt            # Dados salvos em JSON por linha
```

---

## ⚙️ Tecnologias e padrões aplicados

- **PHP 8+**
- **Composer + Autoload PSR-4**
- **PSR-12 (padrão de código)**
- **Princípio SOLID — SRP**
- Arquitetura em **camadas**:
  - **Domain:** regras de negócio e validação  
  - **Application:** orquestração de casos de uso  
  - **Infra:** persistência e acesso a dados  
  - **Public:** interface e rotas HTTP simples

---

## 🧠 Fluxo principal

1. O usuário acessa `index.php` e envia o formulário com `name` e `price`.
2. `create.php` chama o `ProductService`, que:
   - Valida os dados (`SimpleProductValidator`);
   - Gera o próximo ID;
   - Persiste o produto (`FileProductRepository`).
3. `products.php` lê todos os produtos do arquivo e exibe em tabela HTML.

---

## 🧪 Casos de teste manuais

| Caso | Entrada | Resultado esperado |
|------|----------|--------------------|
| 1️⃣ | name="Teclado", price=120.50 | Produto criado e exibido na listagem |
| 2️⃣ | name="T", price=50 | Erro: nome muito curto |
| 3️⃣ | name="Mouse", price=-10 | Erro: preço não pode ser negativo |
| 4️⃣ | Arquivo vazio | Mensagem "Nenhum produto cadastrado" |
| 5️⃣ | Vários cadastros | IDs incrementais e todos listados corretamente |

---

## 📄 Observações

- O projeto não possui edição, exclusão ou autenticação (escopo propositalmente reduzido).  
- A persistência é feita em arquivo texto (`products.txt`), um produto por linha em formato JSON.  
- O foco é **organização de camadas e responsabilidade única** de cada classe.  

---

## ✍️ Autor

Desenvolvido por **Felipe Meireles**, com base nos princípios SOLID e boas práticas de PHP puro.
