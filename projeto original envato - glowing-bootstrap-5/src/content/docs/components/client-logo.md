---
layout: docs
title: Client Logo
group: components
toc: true
---
## Style 01{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
{{- $currentPage := .  -}}
<div class="py-10">
	<div class="slick-slider thumb" data-slick-options='{"slidesToShow": 5,"focusOnSelect": true,"arrows": false, "dots": false, "responsive":[{"breakpoint":992,"settings":{"dots":true,"slidesToShow":3}},{"breakpoint":768,"settings":{"dots":true,"slidesToShow":3}},{"breakpoint":576,"settings":{"dots":true,"slidesToShow":2}}] }'>
		{{ range $item := $.Site.Data.with_client_logo_1 }}
            <div class="client-logo-item">
                {{  partial "the-image" (dict "currentPage" $currentPage "img" $item.image.src "img_dark" $item.image.srcDark "class" "w-auto mx-auto opacity-30" "width" $item.image.width "height" $item.image.height "alt" $item.name) }}
            </div>
		{{- end -}}
	</div>
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}
