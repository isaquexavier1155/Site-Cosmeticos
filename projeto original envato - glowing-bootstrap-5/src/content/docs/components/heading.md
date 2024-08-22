---
layout: docs
title: Heading
toc: true
---
## Style 01{.doc-toc-heading}
{{< docs/example lang="html">}}
{{< sample-code.inline >}}
	{{  partial "elements/heading/style-1" (dict "currentPage" . "title" "Shop by Categories" "subtitle" "Glowing" "desc" "Our products are designed for everyone." ) }}
{{</ sample-code.inline >}}
{{</ docs/example >}}

### Style 01 Align Left{.doc-toc-heading}
{{< docs/example lang="html">}}
{{< sample-code.inline >}}
	{{  partial "elements/heading/style-1" (dict "currentPage" . "title" "Shop by Categories" "subtitle" "Glowing" "align" "left" "desc" "Our products are designed for everyone." ) }}
{{</ sample-code.inline >}}
{{</ docs/example >}}

## Style 02{.doc-toc-heading}
{{< docs/example lang="html">}}
{{< sample-code.inline >}}
	{{ partial  "elements/heading/style-2" (dict "currentPage" .
	"title" "Because You Need Time for Yourself. Blend Beauty in You"
	"subtitle" "OUR PRODUCTS"
	"subheading" "Glowing Beauty"
	"class" "text-center position-relative pt-12 pt-lg-17 pb-11 pb-lg-14 mx-auto"
	"maxWidth" "700px") }}
{{</ sample-code.inline >}}
{{</ docs/example >}}
