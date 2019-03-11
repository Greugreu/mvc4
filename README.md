Framework MVC4

<h2>Installation</h2>
<h3>Prérequis</h3>
<ul>
	<li>PHP >= 7.1.*</li>
	<li>Composer</li>
	<li>MySQL avec PDO</li>
</ul>

<h2>Configurations</h2>

<p>Par sa simplicité, MVC4 ne requière pas tellement de configuration pour fonctionner.</p>

<h3>Le fichier de configuration</h3>

<p>MVC4 est livré avec un fichier nommé <span class="code">config/config.dist.php</span>. Ce fichier est destiné à être versionné, et ne doit pas contenir d'informations personnelles ou sensibles. Le fichier lu par défaut par le framework est <span class="code">app/config.php</span>, qui lui, ne doit pas être versionné, il vous est personnel.</p>

<p>Pour démarrer copier-coller y le contenu du fichier <span class="code">app/config.dist.php</span>.

<pre><code>/* app/config.php */

$w_config = [
   	//information de connexion à la bdd
	'db_host' => 'localhost',						//hôte (ip, domaine) de la bdd
    'db_user' => 'root',							//nom d'utilisateur pour la bdd
    'db_pass' => '',								//mot de passe de la bdd
    'db_name' => '',								//nom de la bdd
    'db_table_prefix' => '',	

**Controlleur Frontal** => /public/index.php

**Routes** => /config/routes.php

<h5>À quoi servent les routes ?</h5>
<p>Les routes permettent d'associer simplement des URL virtuelles à des pages spécifiques de votre site.
 Plus précisémment, elles vous permettent d'exécuter une méthode de contrôleur que vous avez choisie

<h5>Comment créer une nouvelle route ?</h5>
<p>Toutes les routes doivent être définie dans le fichier /config/routes.php

'index.php?page=nameofname&id=.'$id



**Controller** => /app/Controller

<h3>À quoi servent les contrôleurs ?</h3>
<p>Les contrôleurs sont au coeur de vos applications. 
Ce sont eux qui traitent les requêtes et les formulaires, font appel au "modèle" pour manipuler les données, 
exécutent la logique applicative, et finalement, retournent des réponses (habituellement une vue, 
des données brutes ou une redirection) au client.</p>

<h3>Comment créer un contrôleur ?</h3>
<p>Vous pouvez créer autant de contrôleurs que vous le souhaitez. 
Pour vous donner une idée, il est fréquent d'avoir autant de contrôleurs que vous avez de table 
dans votre base de données (bien que ce ne soit nullement une règle à appliquer strictement). 
Ainsi, pour un blog, il y aurait probablement, a minima, un <span class="code">PostController</span>, 
un <span class="code">CommentController</span> et un <span class="code">UserController</span>.</p>

<p>Toutes vos classes devraient être sous l'espace de nom <span class="code">App\Controller</span> 
et hériter (directement ou non) de la classe <span class="code">App\Weblitzer\Controller</span>,
 afin de bénéficier des méthodes fournies.</p>

<h4>La classe App\Weblitzer\Controller</h4>
<p>Il est essentiel de parcourir vous-même la classe <span class="code">App\Weblitzer\Controller</span>,
 afin d'avoir un portrait juste de tout ce qu'elle vous offre.</p>
<p>En quelques mots, sachez qu'elle vous permet de gérer les redirections et les urls, l'envoi de réponses de vue, 
de pages d'erreurs et de JSON.</p>

<h3>Créer une action</h3>
<p>Pour chacune des "pages" de vos applications, une méthode de contrôleur devrait être définie.
 C'est notamment pour cette raison que vous ressentirez le besoin de créer plusieurs contrôleurs, 
 afin de "classer" vos méthodes, qui deviendront rapidement nombreuses.</p>
<p>Ces méthodes doivent être de visibilité <span class="code">public</span>, 
et devrait normalement se terminer par l'une des actions suivantes : 
app/Controller/DefaultController.php </p>

public function demo()
{
	//autre logique ici, puis...

	/** 
	 * Méthodes habituellement utilisées en fin de traitement du contrôleur 
	 */

	//affiche un template
	$this->render('app.default.contact');

	//affiche un template, tout en rendant des données disponibles dans celui-ci
	$this->render('app.default.contact',['username' => 'michel']);

    //redirige vers un site externe
    $this->redirect('index.php?page=contact');

	//redirige vers un site externe
	$this->redirect('https://weblitzer.com');

	//retourne une réponse JSON
	//... $data = [];
	$this->showJson($data);

	//retourne une erreur 404
	$this->Abort404();
	
}



**Model** => /app/Model

<h3>À quoi servent les modèles ?</h3>
<p>Les modèles (ou <span class="code">Model</span>) sont les classes responsables d'exécuter <em>les requêtes à votre base de données</em>.</p>
<p>Concrètement, chaque fois que vous souhaitez faire une requête à la base de données, vous devriez venir y créer une fonction qui s'en chargera (sauf si elle existe déjà dans les modèles de base du framework).</p>

<h3>Comment créer un nouveau modèle ?</h3> 
<p>Dans votre application, vous pourriez avoir un modèle par table MySQL (sans obligation). Chacune de ces classes devraient hériter de <span class="code">\W\Model\Model</span>, le modèle de base du framework, qui vous fera profiter de quelques méthodes utiles pour les requêtes simples à la base de données.</p>

<p>Par exemple, pour créer un modèle relié à une table fictive de commentaires nommées <span class="code">comment</span> : </p>
<pre><code>&lt;?php /* app/Model/CommentModel.php */
namespace Model;

class CommentModel extends \W\Model\Model 
{
	//Récupère les commentaires associés à un article
	public function findPostComments($postId)
	{
		//...
	}
}
</code></pre>

<p>Le nom de la table MySQL correspondante sera automatiquement définit en fonction du nom du modèle transformé en underscore_case (snake_case). Par exemple, si le modèle s'appelle <span class="code">CommentsBlogModel</span>, celui-ci cherchera une table nommée <span class="code">comments_blog</span>.</p>

<h3>Les propriétés et méthodes héritées du Model</h3>
<p>Voici les propriétés et les méthodes les plus utiles, héritées du modèle de base. Vous devrez créer vos propres méthodes pour réaliser toutes les requêtes SQL plus complexes !</p>
<pre><code>/* W/Model/Model.php */

// Propriété contenant le nom de la table (deviné grâce au nom de votre modèle)
protected $table;

// Propriété contenant le nom de la clé primaire de la table (par défaut : 'id')
protected $primaryKey;

// Connexion à la base de données
protected $dbh;

// Définit le nom de la table (si le nom déduit ne convient pas)
public function setTable($table)

// Définit le nom de la clé primaire de la table (si ce n'est pas 'id')
public function setPrimaryKey($primaryKey)

// Récupère une ligne de la table en fonction d'un identifiant
public function find($id)

**View** => /view

<h3>À quoi servent les vues ? </h3>
<p>Les <em>vues</em> ou <em>templates</em> permettent de séparer le code de présentation du reste de la logique (contrôleur) ou des données (modèles). On y retrouve donc essentiellement des balises HTML et des <span class="code">echo</span> de variables PHP.</p>
<p>W utilise un moteur de template nommé <a href="http://platesphp.com/" title="Documentation de Plates">Plates</a>. Plates n'est pas très connu, mais possède un avantage non-négligeable : il utilise PHP comme langage. En effet, la plupart des autres moteurs de templates (comme Twig ou Smarty) impose l'apprentissage d'un nouveau langage. Plates est d'ailleurs fortement inspiré de Twig, le passage de l'un à l'autre se fait assez aisément.</p>

<h3>Comment créer un nouveau fichier de vue ? </h3>
<h4>Où placer ses fichiers de vues ?</h4>
<p>Donnée importante à connaître : W vous impose de placer vos fichiers de vues sous le dossier <span class="code">app/templates/</span>. Outre cette règle, vous êtes libre de faire comme bon vous semble.</p>
<p>Ceci étant, la plupart des pages de votre application devrait avoir un fichier de vue propre. Ainsi, il devrait y avoir à peu près autant de routes que de méthodes de contrôleur que de fichiers de vue dans votre application. Il est donc important de les classer un minimum, afin de s'y retrouver. Pour cette raison, W vous suggère de placer vos fichiers de vue dans des répertoires portant le même nom que son contrôleur (sans le suffixe Controller, et en minuscule). Ainsi, si vous avez un <span class="code">PostController</span> et un <span class="code">UserController</span> dans votre application, vous devriez avoir un dossier de vues nommé <span class="code">app/templates/post/</span> et un autre nommé <span class="code">app/templates/user/</span>. Ce n'est toutefois qu'une convention suggérée.</p>
<p>Les fichiers de vue doivent avoir l'extension <span class="code">.php</span>.</p>
<h4>Que contient un fichier de vue ?</h4>
<p>Au plus simple, un fichier de vue ne doit contenir qu'une page HTML complète. Lorsque votre contrôleur déclenchera l'affichage de votre fichier de vue, il enverra le contenu de celui-ci en réponse au client.</p>
<p>Le problème avec cette approche est bien sûr la duplication de code d'une page à l'autre, pour tous les nombreux éléments communs entre toutes les pages. Nous verrons plus loin comment Plates résoud d'une manière fort élégante ce problème.</p>

<h3>Les CSS, les JS et les images</h3>
<p>Tous les fichiers publics de votre application (<em>publics</em> dans le sens que vous considérez qu'un internaute doit pouvoir l'afficher directement dans son navigateur) doivent se trouver dans le dossier <span class="code">web/</span>. Autrement, le navigateur n'y aura tout simplement pas accès. Ainsi, vos fichiers .css, .js et vos images (souvent nommés <em>assets</em>) devront nécessairement y être placés.</p>
<p>En fait, W prend pour acquis que ces fichiers seront dans le sous-répertoire <span class="code">web/assets/</span>, afin de ranger plus finement ce dossier <span class="code">web/</span>.</p>
<p>À l'exception de cette convention, vous faites vos styles et votre JavaScript comme dans toutes applications classiques : W est un framework back-end, et ne se préoccuppe pas de ce que vous faites côté client.</p>

//génère et retourne l'URL d'une route nommée
		//à utiliser pour tous les liens internes
		echo $this->url("nom_de_la_route", ["nom_du_param" => "value_du_param"]);





