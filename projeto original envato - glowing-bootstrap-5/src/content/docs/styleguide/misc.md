---
layout: docs
title: Misc
description: Learn more about some miscellaneous styling features used in Glowing.
toc: true
---

## Spacing{.doc-toc-heading}

Spacing utilities are declared via Sass map and then generated with our utilities API.

{{< docs/card card_body="false">}}
<div class="card-body">
	<p class="mb-0">Glowing adds additional spacing variables to existing <a
		href="https://getbootstrap.com/docs/5.1/utilities/spacing/" target="_blank">Bootstrap
		spacing</a> ranging between values
		<mark class="doc">0</mark>
		and
		<mark class="doc">25</mark>
	</p>
</div>
{{</ docs/card >}}

## Font Size{.doc-toc-heading}
Quickly change the font-size of text. While our heading classes (e.g., .h1–.h6) apply font-size, font-weight, and line-height, these utilities only apply font-size. Sizing for these utilities matches HTML’s heading elements, so asthe number increases, their size decreases.

Customize your available font-sizes by modifying the $font-sizes Sass map.
{{< docs/example >}}
	<p class="fs-1">.fs-1 text</p>
	<p class="fs-2">.fs-2 text</p>
	<p class="fs-3">.fs-3 text</p>
	<p class="fs-4">.fs-4 text</p>
	<p class="fs-5">.fs-5 text</p>
	<p class="fs-6">.fs-6 text</p>
{{< /docs/example >}}

## Line Height{.doc-toc-heading}
{{< docs/card card_body="false">}}
    <div class="card-body">
        Change the line height with <code>.lh-*</code> utilities.
    </div>
    {{< docs/card-code >}}
    <p class="lh-1"></p>
    <p class="lh-sm"></p>
    <p class="lh-base"></p>
    <p class="lh-lg"></p>
    {{</ docs/card-code >}}
{{</ docs/card >}}

## Letter Spacing{.doc-toc-heading}
{{< docs/card card_body="false">}}
    <div class="card-body">
        Change the letter spacing with <code>.ls-*</code> utilities.
    </div>
    {{< docs/card-code >}}
    <p class="lt-1"></p>
    <p class="lt-2"></p>
    <p class="lt-3"></p>
    <p class="lt-4"></p>
    <p class="lt-5"></p>
    {{</ docs/card-code >}}
{{</ docs/card >}}

## Gutters{.doc-toc-heading}
{{< docs/card card_body="false">}}
<div class="card-body">
	<p class="mb-0">Spacing variables mentioned above can also be used for column gutters. More information regarding
		Bootstrap gutters can be found on <a href="https://getbootstrap.com/docs/5.0/layout/gutters/"
											 target="_blank">Bootstrap docs</a></p>
</div>
{{</ docs/card >}}