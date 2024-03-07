<p align="center">
	<a href="#"  target="_blank" title="Visite CorporatiX">
		<img src="/public/image/readme/corporatix-logo-h-380.png" alt="Sistema CMS CorporatiX" width="340px">
	</a>
</p>

<br>

<p align="center">:sparkles: Sistema CMS CorporatiX :sparkles: - <a href="https://www.corporatix.online">https://www.corporatix.online</a></p>

<p align="center">
	<img src="https://img.shields.io/badge/version project-2.0-brightgreen" alt="version project">
    <img src="https://img.shields.io/badge/Php-8.2.12-informational" alt="stack project">
    <img src="https://img.shields.io/badge/Laravel-10.1-informational&color=brightgreen" alt="stack project">
    <img src="https://img.shields.io/badge/Livewire-3.0-informational&color=brightgreen" alt="stack project">
    <img src="https://img.shields.io/badge/Filament-3.0.1-informational" alt="stack project">
    <img src="https://img.shields.io/badge/TailwindCss-3.1-informational" alt="stack project">
    <img src="https://img.shields.io/static/v1?label=Composer&message=2.6.5&color=brightgreen?style=for-the-badge" alt="stack project">
	<a href="https://opensource.org/licenses/GPL-3.0">
		<img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="GPLv3 License">
	</a>
</p>



## :heavy_check_mark: Requisitos de software

> Avaliação das especificações do software durante o desenvolvimento para verificar se os requisitos de qualidade estão
sendo atendidos.


### :label: Os `requisitos funcionais (RF)`
- [RF001] :white_check_mark:    O Sistema deverá ter um `landing page institucional` que será administravel.
- [RF007]                       O Sistema deve ter `configurações [unico e não deletavel]` para administração de dados da página institucional e admin.
- [RF002] :white_check_mark:    O Sistema terá uma area restrita para os colaboradores e admins (`intranet/App`).
- [RF003] :white_check_mark:    O Sistema terá uma `dashboard` para somente administradores com `menu das funcionalidades`.
- [RF003]                       O sistema terá `controle de acesso` a funcionalidades a partir de suas (ACL) permissões, seja usuário ou admin.
                                    - verificar metodo de acesso user camPanel e propriedade panel do user.
- [RF004]                       O Sistema deve autenticar o `usuários` e `administradores` atravez de `atributo que os definem` [email, passsword, status].
- [RF005]                       O `usuários` poderá acessar somente a area de intranet/App e `administradores` teram acesso a area App e dashboard.
- [RF006]                       O sistema deve ter cadastro de novos usuários somente por administradores, com seu `perfil de acesso` e um `e-mail único`.
- [RF007] :white_check_mark:    O usuário deve ser notificado da sua aprovação via `notificado de e-mail`.
- [RF005]                       O Sistema deve ter estatiscas do trávego de navegação na dashboard.
                                    - Quem pode administrar são Administradores com permissão `dasboard`
                                    - Dados que serão administraveis na área APP [nome site, favicon, ].
                                    - 







- [RF006]                       O Sistema deve ter perguntas frequentes `CommonQuestions`, que serão administradas.

- [RF007] :white_check_mark:    O Sistema deve ter administração de `usuários CRUD`.
                                    - Listagem                              OK
                                    - Criar                                 OK
                                    - Editar                                OK
                                    - Deletar                               OK
                                    - Profile  [REFERÊNCIA *4]                                         
                                    - No listar não pode estar User logado
                                    
- [RF008] :white_check_mark:    O Sistema deve ter administração de `categorias  CRUD` e relações.
- [RF009] :white_check_mark:    O Sistema deve ter administração dos `artigos  CRUD` e relações.
- [RF009] :white_check_mark:    O Sistema deve ter administração dos `tags  CRUD` e relações.
                                    - Clusterizar: Os 3 resources em uma pagina [REFERÊNCIA *5-6]

- [RF010] :white_check_mark:    O Sistema deve permitir a pesquisa de usuários, categorias, tags e artigos.
- [RF011] :white_check_mark:    O Sistema deve ter paginação nas listagens administrativa.
- [RF011]                       O Sistema deve ter paginação nas listagens app.

- [RF018]                       O Sistema deve permitir mudar o status de acesso de um usuário.
- [RF019]                       O Sistema deve permitir contato dos usuário via WhatsApp.
- [RF020]                       O sistema deverá ter integração do `login` com serviço baseado em `OAuth do Google` e/ou `Facebook`.
- [RF021]                       O sistema terá um menu de opções que dê `acesso a todas as funcionalidades` que o sistema provê dependendo do seu `perfil de acesso`.

- [RF023]                       O usuário poderá atualizar seu `endereço`, apos liberação de seu perfil ao sistema, podendo ser vazio.
- [RF024]                       O usuário poderá atualizar seu `cargo`, apos liberação de seu perfil ao sistema, podendo ser vazio.
- [RF025]                       O usuário poderá atualizar sua `unidade` atual, apos liberação de seu perfil ao sistema, podendo ser vazio.

- [RF026]                       O cadastro de um `artigo` deve ser realizado somente por usuários com permissão de acesso a criação.
- [RF026]                       O artigo deve ter `formatação de texto` upload de imagem que poderá ser feito seu download por todos usuários usuários, data de validade final de publicação, views, likes e deslikes e comentários feitos por qualquer usuário usuário liberado.
- [RF026]                       O artigo deve ter uma `categoria`, um `usuário criador` e uma ou mais `tags associado` ao artigo.
- [RF026]                       O artigo deve ter `status de edição` (publicado, rascunho, etc)

- [RF028]                       O usuário deverá ter cadastro de `comentários` se necessário para todos usuários, não sendo necessário ter edição e exclusão do comentário, somente se a publicação for excluída o comentário será deletado.

- [RF029]                       O usuário deverá ter cadastro de `questionários` e imagem se necessário. Os questionários poderão ter uma ou mais questões que terão 4 opções de resposta cadastradas e esses questionários só poderão ser respondidos pelos usuários após finalização.

- [RF030]                       O sistema deverá ter a funcionalidade de `exportação` de dados em formato `Excel ou PDF` nas entidades cargos, categorias, notícias, pedidos de solicitação, questionários, unidades e usuários. 

- [RF031]                       Nos campos do cadastro que estão associados a outras entidades do sistema, o usuário deverá ter o mecanismo de lookup dos dados (combobox ou janela de seleção) e pesquisa, assim podendo selecionar mais rapidamente o item.
- [RF032]                       O sistema deve apresentar pelo menos uma tela em que seja feito cadastro de dados em estrutura mestre/detalhe (duas entidades associadas). Perfil de usuário.

- [RF033]                       ??? O sistema deve apresentar pelo menos 3 telas de processamento de transações com suas respectivas regras de negócio a partir das entidades do sistema.

- [RF034]                       O sistema terá uma tela de relatório (dashboard) com as estatísticas do sistema de forma gráfica (gráfico de barras, gráfico de linhas, etc.) em que sejam mostrados pelo menos 5 indicadores. Os gráficos que serão mostrados:
- [RF035]                       Gráfico de publicações criadas por mês.
- [RF035]                       Gráfico geral de likes (gostar) realizados.
- [RF036]                       Gráfico de publicações por usuário.
- [RF038]                       Gráfico com total de usuários por cargo.
- [RF039]                       Gráfico com total de usuários por unidade.
- [RF040]                       Além dos gráficos, o sistema deverá mostrar quantos usuários estão online no momento, total de publicações, usuários cadastrados ativos, questionários, visualizações, comentários, categorias, deslikes com porcentagem e listagem com total de questionário respondidos por usuário.
- [RF041]                       O sistema permitirá o cadastro das permissões de acesso por admins.
- [RF042]                       O sistema deverá ter um canal com os ramais de todos colaboradores.

- [RF043]                       O sistema deverá apresentar na tela inicial do App a última publicação em destaque, os aniversariantes do mês e uma listagem com as últimas 8 notícias e questionários.


### :label: `requisitos não funcionais (RNF)`
- [RNF001] :white_check_mark: O sistema deve ser implementado em Php.
- [RNF002] :white_check_mark: O sistema deve utilizar framework laravel.
- [RNF003] :white_check_mark: O sistema deve implementado em componentes livewire.
- [RNF004] :white_check_mark: O sistema deve implementar o Filament na área administrativa.
- [RNF004] :white_check_mark: Para alguns dos teste usar o Debugbar.
- [RNF005] :white_check_mark: O sistema deve utiilizar o banco de dados (`phpMyAdmin`) MySql.
- [RNF006] :white_check_mark: O sistema será implementado na arquitetura MVC.
- [RNF007] :white_check_mark: O sistema deve utilizar TailWindCss.
- [RNF008] :white_check_mark: O sistema deve ser implementado utilizando componentes para melhor agilidade de desenvolvimento.
- [RNF009] :white_check_mark: O site deve ser 100% responsivo.
- [RNF010] :white_check_mark: O site deve ter segurança contra ataques.


### :label: Requisitos seguidos
- :star: `Funcionalidade` – Funções do software, que determinam o que o sistema faz. Direcionada para o atendimento dos requisitos do usuário.
- :star: `Confiabilidade` – Atributos que têm impacto na capacidade do software de manter o seu nível de desempenho, dentro de condições estabelecidas, por um dado período de tempo.
- :star: `Usabilidade` - Atributos que respondem pela facilidade de uso do software por usuários com perfil específico.
- :star: `Eficiência` – Relação entre o nível de desempenho do software e a quantidade de recursos utilizada, sob condições de uso pré-definidas.
- :star: `Manutenibilidade` – Medida do esforço necessário para fazer alterações, extensões e complementações no produto de software.
- :star: `Portabilidade` – Facilidade do produto de software ser transferido para outro ambiente computacional e funcionar adequadamente.

## :heavy_check_mark: Prototipagem

A etapa de front end no projeto é uma etapa que estou me desenvolvendo e me atualizando cada vez mais, buscando as melhores praticas de estilização,
codifificação e sempre buscando desafios, com tecnologias novas. 
E neste projeto foi realizado uma pesquisa para se colocar o melhor layout, e personalização para uma experiencia de interface moderna, prática para usuários.

### Models entidades do sistema
- User  `usuário`
- Address `endereço`
- unit  `unidade`
- office  `cargo`
- Setting  `configuração`
- Article  `artigo`
- Article_tag  `artigo tag` | `pivo`
- Tag  `tag`
- Category  `categoria`
- Comment  `comentário`
- Like  `like`
- Role  `função`
- Module  `modulo`
- Permission  `permissão`
- Permission_Role  `permissão função` | `pivo`
- Quiz  `Questionário`
- Question  `questão`
- Answer  `resposta`
- Survey  `enquete`
- SurveyResponse  `enquete resposta` | `pivo`

<p align="center">
	<a href="#"  target="_blank" title="logo">
		<img src="/public/image/readme/iconLogoCorporatix120x142.png" alt="logo" width="180">
	</a>
</p>

- Diagrama Entidade-Relacionamento (DER)

> O diagrama de classes é a representação estática utilizada para descrever a estrutura do sistema, apresentando as classes, atributos, operações e as relações entre os objetos.


<div align="center">
    <h4>Diagrama de classes</h4>
    <img src="/public/image/readme/diagram.JPG" width="100%">
</div>

O diagrama de classes do projeto, foi realizado no software  [`StarUML`](https://staruml.io/)

## :heavy_check_mark: Detalhes técnicos

### Definir arquitetura do projeto


### Definir tecnologias (serviços externos, libs, frameworks, hospedagem etc.)


### Problemas e desafios encontrados


### Prototipagem finais


### Conclusão final

## Lista simples de desenvolvimento
##### A listagem contem todos passos de desenvolvimento, `bibliotecas, pacotes instalados` e configurados para auxiliar nas funcionalidades.
- :label: :heavy_check_mark: Framework Laravel  
- :label: :heavy_check_mark: Filament  
- :label: :heavy_check_mark: Criação das migrates User, Article, Category, Tags e table pivo.
- :label: :heavy_check_mark: Configurações de propriedades das migrates e models.
- :label: :heavy_check_mark: Criação de controllers de todas migrates.
- :label: :heavy_check_mark: Configurações de seeders e factories.
- :label: :heavy_check_mark: Configurações do .env, app/config.
- :label: :heavy_check_mark: Criação das Resources do Filament das migrates.
- :label: :boom: Configurações da ArticleResource de form, table.
        - Criação da página personalizada infolist [REFERÊNCIA *1].
        - add metodo para adicionar o slug dinamicamente pelo title.
        - Criação de Custom Widgets [REFERÊNCIA *2].
        - 
        - 
        - 
        
- :label: :boom: Ajustes da section blog com component article\Grid.
- :label: :boom: Criado as relações de Role, Permission e module.
- :label: :boom: Ajutar avatar de usuário na navbar [REFERÊNCIA *3]
- :label: :boom: 
- :label: 
- :label: 
- :label: [RF007]: Criando class Observer de User para observar os eventos de criação, para posterior envio de e-mail para usuários com seu `Email e senha` de acesso.
                    - https://laravel.com/docs/10.x/eloquent#observers
##### REFERÊNCIAS
- [*1] https://www.youtube.com/watch?v=G0IhDFyj2vU&t=4239s&ab_channel=FilamentBrasil
- [*2] https://filamentphp.com/docs/3.x/panels/resources/widgets#creating-a-resource-widget
- [*2] https://www.youtube.com/watch?app=desktop&v=_VnZAHbK4w4&ab_channel=CodeWithTony
- [*3] https://filamentphp.com/docs/3.x/panels/tenancy#setting-up-avatars
- [*4] https://filamentphp.com/docs/3.x/panels/users#customizing-the-authentication-features
- [*5] https://filamentphp.com/docs/3.x/panels/resources/getting-started#sub-navigation-position
- [*6] https://www.youtube.com/watch?v=V909WVmyGMU&list=PL9zLINrtn0_pNgp-PjrvQXi7fctF-idNC&index=25
- [*]
- [*]

##### Examples links
- Customização da pagina de registrar user [Filament authenticate](https://filamentphp.com/docs/3.x/panels/users#customizing-the-authentication-features)

### :star: Contatos

Contatos 👇🏼 [rafaelblum_digital@hotmail.com]

[![Youtube Badge](https://img.shields.io/badge/-Youtube-FF0000?style=flat-square&labelColor=FF0000&logo=youtube&logoColor=white&link=https://www.youtube.com/channel/UCMvtn8HZ12Ud-sdkY5KzTog)](https://www.youtube.com/channel/UCMvtn8HZ12Ud-sdkY5KzTog)
[![Instagram Badge](https://img.shields.io/badge/-rafablum_-violet?style=flat-square&logo=Instagram&logoColor=white&link=https://www.instagram.com/rafablum_/)](https://www.instagram.com/rafablum_/)
[![Twitter: universoCode](https://img.shields.io/twitter/follow/universoCode?style=social)](https://twitter.com/universoCode)
[![Linkedin: RafaelBlum](https://img.shields.io/badge/-RafaelBlum-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/rafael-blum-378656285/)](https://www.linkedin.com/in/rafael-blum-378656285/)
[![GitHub RafaelBlum](https://img.shields.io/github/followers/RafaelBlum?label=follow&style=social)](https://github.com/RafaelBlum)

<br/>

<img src="https://media.giphy.com/media/LnQjpWaON8nhr21vNW/giphy.gif" width="60"> <em><b>Adoro me conectar com pessoas diferentes,</b> então se você quiser dizer <b>oi, ficarei feliz em conhecê-lo mais!</b> :)</em>
