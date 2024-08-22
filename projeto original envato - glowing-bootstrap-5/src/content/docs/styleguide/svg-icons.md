---
layout: docs
title: SVG Icon
description: Below you can find the list of all SVG icons included in Glowing.
---
## Lineal{.doc-toc-heading}
Below you can find a list of all SVG icons used for Glowing. All these retina ready icons can be easily styled in color and size.
For more new icons. Please visit [Icomoon](https://icomoon.io/#icons). And add it in the file `/layouts/partials/svg-icons.html`.

{{< docs/example lang="html" show_preview="false">}}
<svg class="icon">
	<use xlink:href="#icon-heart"></use>
</svg>
{{</ docs/example >}}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6">
        {{- range $icon := .Site.Data.doc_svg_icon.SVG -}}
        {{- $icon := $icon.id -}}
        <div class="col-md mb-4">
            <div class="card text-center h-100">
                <div class="card-body text-dark">
                    <svg class="icon text-primary fs-1">
                        <use xlink:href="#{{ $icon }}"></use>
                    </svg>
                    <h6 class="card-title text-body mt-3">{{ $icon }}</h6>
                </div>
            </div>
        </div>
        {{- end -}}
	</div>
{{</ sample-code.inline >}}