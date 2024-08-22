---
layout: docs
title: Icon Box
group: components
toc: true
---
## Style 01{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
	{{ partial  "elements/icon-box/style-1" (dict "currentPage" . "title" "Free Shipping" "desc" "Free Shipping for orders over $130" "icon" "icon-box-01" ) }}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Style 02{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
	{{ partial "elements/icon-box/style-2" (dict "title" "Address"
	"icon" "icon-box-07"
	"desc" "<p class=\"mb-2 pb-4 fs-6\">3245 Abbot Kinney BLVD – <br> PH Venice, CA 124</p><p>76 East Houston Street <br> PH Venice, CA 124</p>"
	"btnContent" "Get Direction") }}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}
