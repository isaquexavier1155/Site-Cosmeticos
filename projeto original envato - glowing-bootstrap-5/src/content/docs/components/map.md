---
layout: docs
title: Map
group: components
toc: true
---
## Style Light{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
	{{ partial "elements/map/style-1" (dict
	"id"  "map-01"
	"access_token"  $.Site.Data.mapbox_access_token.access_token
	"height" "500px"
	"mapbox_options"  $.Site.Data.contact_info.mapbox_options
	"mapbox_marker"  $.Site.Data.contact_info.mapbox_marker
	"effect"  "true"
	)}}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Style Dark{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
	{{ partial "elements/map/style-1" (dict
	"id"  "map-02"
	"access_token"  $.Site.Data.mapbox_access_token.access_token
	"height" "500px"
	"mapbox_options"  $.Site.Data.doc_map.mapbox_options_s2
	"mapbox_marker"  $.Site.Data.doc_map.mapbox_marker
	"effect"  "true"
	)}}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}


## Style Navigation Night{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
	{{ partial "elements/map/style-1" (dict
	"id"  "map-03"
	"access_token"  $.Site.Data.mapbox_access_token.access_token
	"height" "500px"
	"mapbox_options"  $.Site.Data.doc_map.mapbox_options_s3
	"mapbox_marker"  $.Site.Data.doc_map.mapbox_marker
	"effect"  "true"
	)}}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}


## Style Outdoors{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
	{{ partial "elements/map/style-1" (dict
	"id"  "map-04"
	"access_token"  $.Site.Data.mapbox_access_token.access_token
	"height" "500px"
	"mapbox_options"  $.Site.Data.doc_map.mapbox_options_s4
	"mapbox_marker"  $.Site.Data.doc_map.mapbox_marker
	"effect"  "true"
	)}}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}


## Style Satellite Streets{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
<div class="py-10">
	{{ partial "elements/map/style-1" (dict
	"id"  "map-05"
	"access_token"  $.Site.Data.mapbox_access_token.access_token
	"height" "500px"
	"mapbox_options"  $.Site.Data.doc_map.mapbox_options_s5
	"mapbox_marker"  $.Site.Data.doc_map.mapbox_marker
	"effect"  "true"
	)}}
</div>
{{</ sample-code.inline >}}
{{< /docs/example >}}