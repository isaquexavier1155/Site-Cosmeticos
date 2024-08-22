---
layout: docs
title: Image Box
group: components
toc: true
---
## Style 01{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
	{{ partial  "elements/image-box/style-1" (dict
	"title" "Moisturizers"
	"subtitle" "12"
	"img" "/assets/images/image-box/image-box-04.jpg"
	) }}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Style 02{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
    {{ partial  "elements/image-box/style-2" (dict "currentPage" . "title" "Guaranteed PURE" "subtitle" "All Grace formulations adhere to strict purity standards and will never contain harsh or toxic ingredients" "img_dark" "/assets/images/image-box/image-box-white-11.png" "img" "/assets/images/image-box/image-box-11.png"
    "altContent" "Guaranteed PURE" "imgWidth" "102" "imgHeight" "118") }}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Style 03{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
	{{ partial  "elements/image-box/style-3" (dict "title" "Guaranteed PURE" "subtitle" "All Grace formulations adhere to strict purity standards and will never contain harsh or toxic ingredients" "img" "/assets/images/image-box/image-box-16.png"
	"altContent" "Guaranteed PURE") }}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Style 04{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10" style="max-width:720px">
	{{ partial "elements/image-box/style-4" (dict
	"currentPage" .
	"class" "hover-zoom-in rounded-0"
	"contentClass" "d-none"
	"img" "/assets/images/banner/banner-11.jpg"
	"imgClass" "img-fluid lazy-image w-100"
	) }}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Style 05{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10" style="max-width:960px">
	{{ partial "elements/image-box/style-5" (dict "title" "shroom serum"
	"subtitle" "Lorem ipsum dolor sit amet, consectetur adipi, scing seddo eiusmod temporincididunt ut labore et dolore magna aliqua."
	"hotproduct" "Hot Product" "img" "/assets/images/image-box/image-box-22.png"
	) }}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Style 06{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10" style="max-width:960px">
	{{ partial "elements/image-box/style-6" (dict "title" "Because You Need Time for Yourself. Blend Beauty in You" "subtitle" "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur" "logo" "/assets/images/others/other-image-07.png") }}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}
