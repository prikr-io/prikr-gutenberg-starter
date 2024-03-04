# What do we need?
- Hot-module reload
- Compiler like Vite or Webpack
- Efficient folder structure
- Tailwind included (ratio, forms)
- Disable jQeury in frontend
- Use Reactjs for Block development
- Simple integration with Local
- Using highest versions of NPM and Nodejs
- Github actions for deployment
- Aim for > PHP 8.2
- SEO optimized
- Multi-language support
- Lazyload iamges
- Tests PHP: PHPUnit, JavaScript: Jest
- ESlint
- PHP_CodeSniffer
- Pettier

# Prikr Gutenberg Starter
This is a starter theme for WordPress, using the Gutenberg editor. It's a modern theme, using the latest technologies and best practices.

## Understanding of blocks, block-templates and block-template-parts
The theme is structured in a way that it separates the different parts of the theme into different directories. This includes the custom blocks, block templates, and block template parts. Here's a brief overview of each:
### Custom Blocks (`src/php/blocks` or `src/js/blocks`)
**Purpose**: Custom blocks are individual, reusable elements that you create for users to use within the Gutenberg editor. They are like 'widgets' or 'modules' that can be added to any post or page within the editor.
**Location**: The JavaScript (and potentially PHP for dynamic blocks) files for these custom blocks should be placed in the `src/js/blocks` (for JavaScript/JSX files) or `src/php/blocks` (for PHP files, in case of dynamic blocks) directory.
**Compilation**: The JavaScript files for these blocks need to be compiled (as discussed in the previous message) and then enqueued in WordPress.
**Usage**: Once you create a custom block, it appears in the Gutenberg editor's block library and can be inserted into any post or page.

### Block Templates (`block-templates`)
**Purpose**: Block templates define the layout and structure of entire pages or post types using a combination of blocks. They are like page templates in traditional WordPress but built entirely with blocks.
**Location**: The `block-templates` directory in your theme’s root contains these templates.
**Content**: These are usually HTML files that specify which blocks are used and how they are arranged. For example, a basic post template might include a title block, a content block, and a comments block.

### Block Template Parts (`block-template-parts`)
**Purpose**: Template parts are reusable parts of your site’s design that are used in multiple block templates. Common examples include headers, footers, and sidebars.
**Location**: The `block-template-parts` directory in your theme’s root is where these parts are stored.
**Content**: Similar to block templates, these are also HTML files containing a group of blocks that make up a section of a page.

### Example Scenario
**Custom Block**: You create a custom block called "My Custom Block" for displaying a special content element. This block's code is in `src/js/blocks/my-custom-block.js`.
**Block Template**: You have a page template that uses "My Custom Block". This template is an HTML file in `block-templates` named something like `custom-page.html`.
**Block Template Part**: Within this template, you include a header and footer, which are template parts located in `block-template-parts`, named `header.html` and `footer.html`.


In summary, your custom blocks don't end up in the `block-templates` or `block-template-parts` folders. Instead, they are used within the block templates or template parts that you define in these respective folders.

## Actions
With this theme, you'll need to add several Github Action `secrets` and `variables`.

### Secrets
`PRIVATE_RSA_KEY` - 
| Variable             | Description |
| :---                 | :---        |
| `PRIVATE_RSA_KEY`    | The private SSH key that will be used to connect to the server. |

### Variables
| Variable          | Description | Example     |
| :---              | :---        | :---        |
| `SSH_USERNAME`    | The username that will be used to connect to the server.       | `project_name`  |
| `DEV_SITE_URL`    | The URL of the development site. This is used to trigger the deployment of the site.        | `https://staging.project.dev`  |
| `DEV_DESTINATION_PATH` | The path to the development site. This is used to deploy the site.        | `/home/project_name/domains/staging.project.dev/public_html`   |
| `PROD_SITE_URL`   | The URL of the production site. This is used to trigger the deployment of the site.        | `https://project.dev`   |
| `PROD_DESTINATION_PATH` | The path to the production site. This is used to deploy the site.        | `/home/project_name/domains/project.dev/public_html`   |


## SSH
The starter theme from prikr has an active CI/CD pipeline that runs through Github Actions. For this to work you'll need to setup a secure SSH-key between Github & the server. This is a step-by-step guide on how to do this.

### 1. Creating the SSH key
- Log on to your server using SSH
- Create an SSH keygen on the server, using the following command: `ssh-keygen -m PEM -t rsa -P "" -f github_actions_rsa`.
  - _If you wish you can change the name of the key, which we will default to `github_actions_rsa`._
- Add the RSA key to the authorized keys using `cat github_actions_rsa.pub >> authorized_keys`.
- Now you'll have to copy the private key, using `cat github_actions_rsa` and copy the contents.
  - important: also copy the `---- BEGIN -----` and `----- END -----` comments.

### 2. Saving the SSH key in Github Actions
- Go to your Github Repository => settings => Secrets and Variables => Actions.
- Create a new `secret` with the name `PRIVATE_RSA_KEY`. Copy the contents of the SSH key you created in the first steps.

### 3. Save the SSH username in Github Actions
- Also, in this same area create a new `variable` with the name `SSH_USERNAME`. As content it should have the SSH username, obviously. Which in our case will be the same as the DirectAdmin username.

### 4. Authorizing the SSH key in DirectAdmin
- Go to the DirectAdmin user account and authorize the SSH key. You can do this at https://directadmin.url:2222`/user/ssh-keys/public`. Without this you'll have your permissions denied.
  - Perhaps this can be done via SSH also, but idk how yet..

### 5. Set the deploy path in github/workflows
Lastly, we need to know where to deploy the site 🙃.
- Navigate to ./github/workflows/ one of the workflows, and adjust the path accordingly

#### -- Troubleshooting
- Keep getting the following error? _Permission denied (publickey,gssapi-keyex,gssapi-with-mic,password)._
  - Try running the following commands:
    `chmod 700 ~/.ssh`
    `chmod 600 ~/.ssh/authorized_keys`

[<img alt="Deployed with web deploy" src="https://img.shields.io/badge/Deployed With-web deploy-%3CCOLOR%3E?style=for-the-badge&color=0077b6">](https://github.com/SamKirkland/web-deploy)
