<!-- PROJECT LOGO -->
<br />
<div align="center">
    <a href="https://github.com/gui-silva-github/Kepler">
        <img src="assets\logo.png" alt="Logo" width="250">
    </a>
    <h3 align="center">Kepler | SGE</h3>
    <p align="center">
        Oferecendo a solução que você procura.
        <br>
        <br>
        <a href="https://leadsconsulting.com.br">Acesse o site</a> ·
        <a href="https://github.com/gui-silva-github/Kepler/issues">Reportar Problema</a> ·
        <a href="https://github.com/gui-silva-github/Kepler/pulls">Sugestões</a>
    </p>

[![HitCount](https://hits.dwyl.com/gui-silva-github/kepler-sge.svg?style=flat-square)](http://hits.dwyl.com/gui-silva-github/kepler-sge)
</div>

<hr>
<!-- PROJECT SUMMARY -->

### Sumário
<ul>
    <li>
        <a href="#sobre-o-projeto">Sobre o Projeto</a>
        <ul>
            <li>O que facitamos?</li>
            <li>Por que escolher o Kepler?</li>
            <li>Tecnologias</li>
        </ul>
    </li>
    <li>
        <a href="#guia-para-devs">Guia para Devs</a>
        <ul>
            <li>Instalação</li>
            <li>Configuração</li>
        </ul>
    </li>
</ul>

<br>

<!-- ABOUT THE PROJECT -->
## Sobre o Projeto

O Kepler é um sistema de gerenciamento escolar projetado e desenvolvido por **três alunos do terceiro ano do ensino médio**, para simplificar e otimizar processos do gerenciamento escolar e educacional. Combinando tecnologia, eficiência e foco no usuário, o Kepler oferece uma solução completa para escolas, professores, alunos e pais.

![Kepler homepage](https://i.ibb.co/WkHDFWW/kepler-homepage.png)

### O que facitamos?
* **Gestão de Alunos e Turmas:** Cadastre e gerencie informações detalhadas dos alunos, incluindo histórico acadêmico, presença e notas.
* **Controle de Frequência e Notas:** Registro de presença dos alunos e notas e avaliações de forma rápida e eficiente.
* **Acesso Seguro e Personalizado:** Acesso restrito às informações relevantes. A segurança dos dados é prioridade, garantindo privacidade e confidencialidade.

### Por que escolher o Kepler?
* **Simplicidade:** Nossa interface intuitiva torna o gerenciamento escolar fácil e acessível.
* **Eficiência:** Automatize tarefas manuais e economize tempo.
Suporte Contínuo: Oferecemos suporte técnico e treinamento para maximizar o uso da plataforma.

Juntos, vamos transformar a educação e criar um ambiente de aprendizado mais eficiente e colaborativo.

### Tecnologias

O Kepler foi desenvolvido e é constituido com populares e avançadas tecnologias.

* ![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white) ![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)

* ![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)

* ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)

* ![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white) ![Nginx](https://img.shields.io/badge/nginx-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white)

Tecnologias consistentes e avançadas para prover melhor usabilidade e segurança para sua instituição e seus alunos.

## Guia para Devs

Para contributir com o projeto é necessário um passo a passo a ser seguido:

1. Clonar Repositório:
```bash
$ git clone https://github.com/gui-silva-github/kepler-sge.git
$ cd kepler-sge
```

2. Instalar Dependências e Atualizar o autoloader

```bash
$ composer install
$ composer dump-autoload
```
3. Configuarar aquivo env.php

```bash
$ cp ./env.php.example ./env.php
```
Abra de modifique o arquivo 'env.php':
```php
define('DB_HOST', 'seu host');
define('DB_SQUEMA', 'sua tabela');
define('DB_USER', 'seu user');
define('DB_PASS', 'sua senha');
```

4. Inicie o servidor de desenvolvimento:

```bash
$ php -S localhost:8080
```
Ou utilize altenativos como XAMPP entre outros