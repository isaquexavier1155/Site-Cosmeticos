---
layout: docs
title: Getting Started
description: Guide to get started with Glowing Modern & Multipurpose Bootstrap 5 Template.
group: usage
toc: true
---
{{< docs/h2 >}}Quick start{{</ docs/h2 >}}

This guide will help you get started with Glowing. All the information regarding file structure, build tools, components, credits, license and FAQ can be found here.

If you have any questions that are beyond the scope of this help document, please create a ticket on our support page.

<a class="btn btn-dark rounded me-4" href="https://themeforest.net/user/g5theme">Contact Form</a><a class="btn rounded btn-primary" href="https://sp.g5plus.net/">Support Page</a>

{{< docs/callout >}}
**Please remember...**
- Requests sent during weekends or on holidays will be replied on business days.
- We only provide support for the issues related to the features that are included in the template. Debugging or providing guides on how to make custom modifications are not part of our support. Thank you for understanding.
{{< /docs/callout >}}

{{< docs/h2 >}}File Structure{{</ docs/h2 >}}

Once downloaded, unzip the compressed folder and you'll see something like this:

```text
glowing/
├── dist/
├── scss/
│	├── bootstrap/
├── src/
│	└── assets/
│	└── content/
│	└── data/
│	└── layouts/
│	└── static/
├── config.yaml
└── package.json
```


<ul class="list-unstyled mb-0">
  <li><code class="folder">dist</code> All template distribution files like HTML / CSS / JS that have been processed (compiled / minified) from <code class="folder">src</code> folder using <code class="doc">Node.js / Hugo</code>.</li>
  <li><code class="folder">scss/bootstrap</code> Contains all <code class="file">.scss</code> file of bootstrap framework</li>
  <li><code class="folder">src</code> All template source files like HTML / SCSS / CSS / JS that are then processed (compiled / minified) to <code class="folder">dist</code> folder.
	<ul>
		<li><code class="folder">src/assets/js</code> Contains project JS files that are processed (compiled / minified) to <code class="file">dist/assets/js/theme.min.js</code>.</li>
	  	<li><code class="folder">src/assets/scss</code> Contains all project SCSS files that are compiled and minified in <code class="folder">dist/assets/css</code> folder.</li>
		<li><code class="folder">src/data</code> This directory is used to store configuration files that can be used by Hugo when generating your website. You can write these files in YAML, JSON, or TOML format. In addition to the files you add to this folder, you can also create data templates that pull from dynamic content.</li>
		<li><code class="folder">src/layouts</code> Stores templates in the form of <code class="file">.html</code> files that specify how views of your content will be rendered into a static website.</li>
		<li><code class="folder">src/static</code> Stores all the static content: images, CSS, JavaScript, etc. When Hugo builds your site, all assets inside your static directory are copied over as-is.</li>
	</ul>
  </li>
  <li><code class="folder">dist/docs</code> Contain all documentation files (installation, blocks, elements, etc.) regarding the template. You can also reach the documentation from the <a href="https://templates.g5plus.net/glowing/docs/index.html" class="external" target="_blank">live demo</a> as well.</li>
  <li><code class="file">package.json</code> Includes the list of dependencies to install from npm.</li>
  <li><code class="file">config.yaml</code> Hugo uses the config.toml, config.yaml, or config.json (if found in the site root) as the default site config file. Learn more about it from <a href="https://gohugo.io/getting-started/">Working with Hugo</a> section or <a href="https://gohugo.io/getting-started/configuration/" target="_blank">Hugo documentation</a>.</li>
</ul>

{{< docs/h2 >}}Installation{{</ docs/h2 >}}

{{< docs/callout >}}
This step is optional. It aims at advanced user who wants to speed up the development process with a professional grade Front-End toolset shipped with GoHugo.
If you are not familiar with these tools and have no time to dive in you can still use plain HTML / CSS / JS to customize GoHugo.
Files you need are located inside <code class="folder">dist</code> folder. In this case, you can skip this and the next sections.
Happy coding :)
{{< /docs/callout >}}

If you'd like to speed up development process with Node.js / Hugo / SASS, then follow these steps:

<ul class="list-unstyled">
	<li>1. Install <code class="code"><a href="https://nodejs.org/en/" target="_blank" class="text-white">Node.js</a></code> if you don’t have it yet.</li>
	<li>2. Unzip the template package and in the root project folder <code class="folder">Glowing</code>, go to your command line and run <code class="code">npm install</code>. This will install the npm packages listed in the <code class="file">package.json</code> file.</li>
	<li>3. You should now have the project files set up and all the npm packages installed.</li>
</ul>

{{< docs/h2 >}}Hugo Commands{{</ docs/h2 >}}

Speed up your workflow with commands You can see more here <a href="https://gohugo.io/commands/" target="_blank">https://gohugo.io/commands/</a>

<ul>
	<li><code class="code">hugo [flags]</code> hugo builds your site.</li>
	<li><code class="code">hugo mod clean [flags]</code> Delete the Hugo Module cache for the current project.</li>
	<li><code class="code">hugo version [flags]</code> Print the version number of Hugo.</li>
	<li><code class="code">hugo new site [path] [flags]</code> Create a new site (skeleton).</li>
	<li><code class="code">hugo server [flags]</code> A high performance webserver.</li>
	<li><code class="code">hugo mod npm [flags]</code> Various npm (Node package manager) helpers.</li>
	<li><code class="code">hugo mod npm pack [flags]</code> Experimental: Prepares and writes a composite package.json file for your project.</li>
</ul>


