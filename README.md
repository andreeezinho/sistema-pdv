# sysGV (Sistema Gestor de Vendas)

Sistema de gestão de vendas e ponto de caixa desenvolvido com **PHP Puro/Sem Frameworks**, que busca seguir boas práticas no desenvolvimento e sua arquitetura. 
O projeto busca implementar tecnologias e padrões que garantem a organização, escalabilidade e manutenções futuras.

---

## Tecnologias, Padrões e Arquiteturas

- **PHP Puro**
- **Arquitetura MVC**
- **Organização de rotas personalizadas**
- **Clean Code**
- **Princípios SOLID**
- **Padrão Singleton**
- **TailwindCSS** (Front-end)

---

## Funcionalidades do Sistema

- Gerenciamento de Usuários com cargos (Administrador, Frente de Caixa, Repositor, Entregador)
- Gerenciamento de Clientes e Fornecedores
- Gerenciamento de Produtos e Estoques e suas Tributações
- Painel do Ponto de Caixa para realizar venda dos produtos
- Painal administrativo para gerenciamento do sistema utilizando gráficos resposivos com Charts Flowbite
- Gerenciamento de Notas Ficais (Entrada, Saída, Tributações)
- Geração de Relatórios personalizados de vendas e produtos
- Rotas dinâmicas e personalizadas
- Customização de variáveis de ambiente via `/env/app.php`

Algumas Imagens do Projeto:

<img width="426" height="240" alt="Screenshot from 2025-12-31 13-30-52" src="https://github.com/user-attachments/assets/f9c74e4e-fbcf-4dff-a0b4-7f5cbd3e6dfa" /> <img width="426" height="240" alt="Screenshot from 2025-12-31 13-16-43" src="https://github.com/user-attachments/assets/9b938494-efdf-4f36-bed8-5b11921a7150" />

<img width="426" height="240" alt="Screenshot from 2025-12-31 13-17-59" src="https://github.com/user-attachments/assets/3f9bf076-00d4-4e86-b90e-e320ae68db61" /> <img width="426" height="240" alt="Screenshot from 2025-12-31 13-31-33" src="https://github.com/user-attachments/assets/b32f6095-25e2-4592-bd8c-c3151611d726" />

<img width="426" height="240" alt="Screenshot from 2025-12-31 13-42-36" src="https://github.com/user-attachments/assets/4ae789d4-305a-45c8-9f59-b4d362aa9984" />

---

## Estrutura de Pastas

```plaintext
app
├── bd.sql
├── composer.json
├── composer.lock
├── .gitignore
├── index.php
├── phpunit.xml
├── public
│   ├── css
│   ├── img
│   └── js
├── README.md
├── src
│   ├── Config
│   ├── Controllers
│   ├── env
│   ├── Interfaces
│   ├── Models
│   ├── Repositories
│   ├── Request
│   ├── Resources
│   ├── Routers
│   ├── Services
│   └── Utils
├── tests
```

---

## Execução do Projeto

### 1 - Clonar repositório

```bash
git clone https://github.com/andreeezinho/sistema-pdv.git
```

### 2 - Remover '.example.' de `src/env/app.example.php`

### 3 - Inserir valores nas variáveis
```bash
const SITE_NAME = 'Sistema Gestor de Vendas';
const URL_SITE = '';
const LOGO = '/public/img/site/logo.png';
const COLORED_LOGO = '/public/img/site/logo-colorida.png';
const DB_HOST = 'mysql';
const DB_NAME = 'db';
const DB_USER = 'root';
const DB_PASSWORD = '12345';

const EMAIL = 'seuemail@gmail.com';
const EMAIL_PASSWORD = 'gfte esjt eqes qhmm'; ## Senha do SMTP que precisa cadastrar

const CERTIFICATE = '' ## Certificado Digital da Empresa
```

### 4 - Copiar ```db.sql``` para o seu banco de dados

### 5 - Executar projeto
```bash
php -S localhost:8888 -t ./
```

## Sobre Certificado Digital para Notas Fiscais no Sistema

Deve-se copiar o seu certificado digital para dentro da raiz do projeto, logo depois, adiciona a rota do arquivo para a variável `CERTIFICATE` no arquivo `src/env/app.php`.
```bash
const CERTIFICATE = '../../seu-certificado.pfx'
```

Por preferência, use um certificado do tipo ```.pfx``` para que não haja nenhum problema eventual.
