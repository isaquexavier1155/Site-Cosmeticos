---
layout: docs
title: Font Awesome
description: Font Awesome is the Internet's icon library and toolkit, used by millions of designers, developers, and content creators.
toc: true
---
## Prologue{.doc-toc-heading}
Glowing is using icons from Font Awesome library 6th edition. Below you can find the icon font icon list. All these retina ready icons can be easily styled to color, size, shadow and anything is possible with CSS. For more information,Find more icons please visit [Fontawesome](https://fontawesome.com/search?m=free) website

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
    {{- range $icon := .Site.Data.doc_font_icon.Arrows -}}
	{{- $title := $icon.title -}}
	{{- $icon := $icon.icon -}}
	<div class="col-md mb-4">
		<div class="card text-center h-100">
			<div class="card-body text-body-emphasis">
				<span class="fs-4">{{ $icon }}</span>
				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
			</div>
		</div>
	</div>
	{{- end -}}
	</div>
{{</ sample-code.inline >}}

## Brand Logos{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
    {{- range $icon := .Site.Data.doc_font_icon.brandLogos -}}
    	{{- $title := $icon.title -}}
    	{{- $icon := $icon.icon -}}
    	<div class="col-md mb-4">
    		<div class="card text-center h-100">
    			<div class="card-body text-body-emphasis">
    				<span class="fs-4">{{ $icon }}</span>
    				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
    			</div>
    		</div>
    	</div>
    	{{- end -}}
    </div>
{{</ sample-code.inline >}}

## Business{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
    {{- range $icon := .Site.Data.doc_font_icon.Business -}}
        {{- $title := $icon.title -}}
        {{- $icon := $icon.icon -}}
        <div class="col-md mb-4">
            <div class="card text-center h-100">
                <div class="card-body text-body-emphasis">
                    <span class="fs-4">{{ $icon }}</span>
                    <h6 class="card-title text-body mt-2">{{ $title }}</h6>
                </div>
            </div>
        </div>
    {{- end -}}
    </div>
{{</ sample-code.inline >}}

## Chat{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
    {{- range $icon := .Site.Data.doc_font_icon.Chat -}}
        {{- $title := $icon.title -}}
        {{- $icon := $icon.icon -}}
        <div class="col-md mb-4">
            <div class="card text-center h-100">
                <div class="card-body text-body-emphasis">
                    <span class="fs-4">{{ $icon }}</span>
                    <h6 class="card-title text-body mt-2">{{ $title }}</h6>
                </div>
            </div>
        </div>
    {{- end -}}
    </div>
{{</ sample-code.inline >}}

## Cloud and Web{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
    {{- range $icon := .Site.Data.doc_font_icon.cloudAndWeb -}}
	{{- $title := $icon.title -}}
	{{- $icon := $icon.icon -}}
	    <div class="col-md mb-4">
		<div class="card text-center h-100">
			<div class="card-body text-body-emphasis">
				<span class="fs-4">{{ $icon }}</span>
				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
			</div>
		</div>
	</div>
	 {{- end -}}
    </div>
{{</ sample-code.inline >}}

## Communication{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
        {{- range $icon := .Site.Data.doc_font_icon.Communication -}}
            {{- $title := $icon.title -}}
            {{- $icon := $icon.icon -}}
            <div class="col-md mb-4">
                <div class="card text-center h-100">
                    <div class="card-body text-body-emphasis">
                        <span class="fs-4">{{ $icon }}</span>
                        <h6 class="card-title text-body mt-2">{{ $title }}</h6>
                    </div>
                </div>
            </div>
        {{- end -}}
    </div>
{{</ sample-code.inline >}}

## Construction{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
        {{- range $icon := .Site.Data.doc_font_icon.Construction -}}
        	{{- $title := $icon.title -}}
        	{{- $icon := $icon.icon -}}
        	<div class="col-md mb-4">
        		<div class="card text-center h-100">
        			<div class="card-body text-body-emphasis">
        				<span class="fs-4">{{ $icon }}</span>
        				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
        			</div>
        		</div>
        	</div>
        	{{- end -}}
    </div>
{{</ sample-code.inline >}}

## Content{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
        {{- range $icon := .Site.Data.doc_font_icon.Content -}}
        	{{- $title := $icon.title -}}
        	{{- $icon := $icon.icon -}}
        	<div class="col-md mb-4">
        		<div class="card text-center h-100">
        			<div class="card-body text-body-emphasis">
        				<span class="fs-4">{{ $icon }}</span>
        				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
        			</div>
        		</div>
        	</div>
        	{{- end -}}
    </div>
{{</ sample-code.inline >}}

## Design Tools{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
        {{- range $icon := .Site.Data.doc_font_icon.designTools -}}
        	{{- $title := $icon.title -}}
        	{{- $icon := $icon.icon -}}
        	<div class="col-md mb-4">
        		<div class="card text-center h-100">
        			<div class="card-body text-body-emphasis">
        				<span class="fs-4">{{ $icon }}</span>
        				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
        			</div>
        		</div>
        	</div>
        	{{- end -}}
    </div>
{{</ sample-code.inline >}}

## Devices{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
        {{- range $icon := .Site.Data.doc_font_icon.Devices -}}
        	{{- $title := $icon.title -}}
        	{{- $icon := $icon.icon -}}
        	<div class="col-md mb-4">
        		<div class="card text-center h-100">
        			<div class="card-body text-body-emphasis">
        				<span class="fs-4">{{ $icon }}</span>
        				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
        			</div>
        		</div>
        	</div>
        	{{- end -}}
    </div>
{{</ sample-code.inline >}}

## Emoji{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
        {{- range $icon := .Site.Data.doc_font_icon.Emoji -}}
        	{{- $title := $icon.title -}}
        	{{- $icon := $icon.icon -}}
        	<div class="col-md mb-4">
        		<div class="card text-center h-100">
        			<div class="card-body text-body-emphasis">
        				<span class="fs-4">{{ $icon }}</span>
        				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
        			</div>
        		</div>
        	</div>
        	{{- end -}}
    </div>
{{</ sample-code.inline >}}

## Security{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
        {{- range $icon := .Site.Data.doc_font_icon.Security -}}
        	{{- $title := $icon.title -}}
        	{{- $icon := $icon.icon -}}
        	<div class="col-md mb-4">
        		<div class="card text-center h-100">
        			<div class="card-body text-body-emphasis">
        				<span class="fs-4">{{ $icon }}</span>
        				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
        			</div>
        		</div>
        	</div>
        	{{- end -}}
    </div>
{{</ sample-code.inline >}}

## Shopping{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
        {{- range $icon := .Site.Data.doc_font_icon.Shopping -}}
        	{{- $title := $icon.title -}}
        	{{- $icon := $icon.icon -}}
        	<div class="col-md mb-4">
        		<div class="card text-center h-100">
        			<div class="card-body text-body-emphasis">
        				<span class="fs-4">{{ $icon }}</span>
        				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
        			</div>
        		</div>
        	</div>
        	{{- end -}}
    </div>
{{</ sample-code.inline >}}

## Users{.doc-toc-heading}

{{< sample-code.inline >}}
    <div class="row row-cols-2 row-cols-md-4 mb-4">
        {{- range $icon := .Site.Data.doc_font_icon.Users -}}
        	{{- $title := $icon.title -}}
        	{{- $icon := $icon.icon -}}
        	<div class="col-md mb-4">
        		<div class="card text-center h-100">
        			<div class="card-body text-body-emphasis">
        				<span class="fs-4">{{ $icon }}</span>
        				<h6 class="card-title text-body mt-2">{{ $title }}</h6>
        			</div>
        		</div>
        	</div>
        	{{- end -}}
    </div>
{{</ sample-code.inline >}}
