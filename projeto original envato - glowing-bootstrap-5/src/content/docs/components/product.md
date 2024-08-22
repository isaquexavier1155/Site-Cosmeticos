---
layout: docs
title: Product
group: components
toc: true
---
## Component #1{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
{{- range $index, $item := $.Site.Data.doc_product -}}
		{{- if eq $index 0 -}}
		<div style="max-width: 330px">
			{{ partial  "elements/shop/skins/grid-1" (dict
			"data" $item
			) }}
		</div>
		{{- end -}}
	{{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #2{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
{{- range $index, $item := $.Site.Data.doc_product -}}
		{{- if eq $index 0 -}}
		<div style="max-width: 330px">
			{{ partial  "elements/shop/skins/grid-2" (dict
			"data" $item
			) }}
		</div>
		{{- end -}}
	{{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #3{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
{{- range $index, $item := $.Site.Data.doc_product -}}
		{{- if eq $index 1 -}}
		<div style="max-width: 450px">
			{{ partial  "elements/shop/skins/grid-3" (dict
			"data" $item
			) }}
		</div>
		{{- end -}}
	{{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #4{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
{{- range $index, $item := $.Site.Data.doc_product -}}
		{{- if eq $index 2 -}}
			{{ partial  "elements/shop/skins/list" (dict
			"data" $item
			) }}
		{{- end -}}
	{{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}
