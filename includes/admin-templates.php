<?php

if (!class_exists('Bentral_Admin_Templates')) {
    class Bentral_Admin_Templates
    {
        public static function templateList()
        {
            return [
                ['value' => 'simple', 'name' => 'Simple'],
                ['value' => 'modern', 'name' => 'Modern'],
                ['value' => 'realestate', 'name' => 'Realestate'],
                ['value' => 'floating', 'name' => 'Floating'],
                ['value' => 'travel', 'name' => 'Travel'],
                ['value' => 'darkImage', 'name' => 'Dark image'],
                ['value' => 'trata', 'name' => 'Trata'],
                ['value' => 'jasna', 'name' => 'Jasna'],
            ];
        }

        public static function templateResults($type)
        {
            switch ($type) {
                case 'simple':
                    return [
                        'template' => '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-2">
	<div class="rounded-lg shadow-lg">
		<a href="{{ link }}">
			<div class="h-48 w-full overflow-hidden">
				<div class="w-full h-full bg-cover hover-zoom" style="background-image:url({{ image_url }})" alt="{{ title }}"></div>
			</div>
		</a>
		<div class="px-6 py-4">
			<div class="font-bold text-xl mb-2">{{ title }}</div>					
		</div>
		<div class="px-6 pt-4 pb-2">
			<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ capacity_basic_title }}:{{ capacity_basic_value }}</span>
			<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ capacity_additional_title }}: {{ capacity_additional_value }}</span>
			<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ price }} {{ currency }}</span>
			
		</div>
		<div class="px-6 py-4">
			<a href="{{ link }}" class="w-full block text-center px-6 py-2 text-gray-700 border-2 border-gray-500 hover:bg-gray-500 hover:text-indigo-100">{{ book_title }}</a>
		</div>
	</div>
</div>', 'style' => '/* ' . mb_strtoupper($type) . ' */'
                    ];
                case 'modern':
                    return [
                        'template' => '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-2">
    <section class="shadow-lg mx-auto max-w-sm ">
        <a href="{{ link }}">
            <div class="h-48 w-full overflow-hidden">
                <div class="w-full h-full bg-cover hover-zoom" style="background-image:url({{ image_url }})" alt="{{ title }}"></div>
            </div>
        </a>
        <div class="p-7 my-auto pb-7 ">
            <h1 class="text-2xl font-semibold text-gray-800">{{ title }}</h1>                
        </div>
		<div class="flex p-4 border-t border-b text-xs text-gray-700">
		    <span class="flex items-center mb-1 w-1/2">
                <img class="mr-2 w-px-24" style="width:20px"  src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU1IDU1IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1NSA1NTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIGQ9Ik01NSwyNy41QzU1LDEyLjMzNyw0Mi42NjMsMCwyNy41LDBTMCwxMi4zMzcsMCwyNy41YzAsOC4wMDksMy40NDQsMTUuMjI4LDguOTI2LDIwLjI1OGwtMC4wMjYsMC4wMjNsMC44OTIsMC43NTIgIGMwLjA1OCwwLjA0OSwwLjEyMSwwLjA4OSwwLjE3OSwwLjEzN2MwLjQ3NCwwLjM5MywwLjk2NSwwLjc2NiwxLjQ2NSwxLjEyN2MwLjE2MiwwLjExNywwLjMyNCwwLjIzNCwwLjQ4OSwwLjM0OCAgYzAuNTM0LDAuMzY4LDEuMDgyLDAuNzE3LDEuNjQyLDEuMDQ4YzAuMTIyLDAuMDcyLDAuMjQ1LDAuMTQyLDAuMzY4LDAuMjEyYzAuNjEzLDAuMzQ5LDEuMjM5LDAuNjc4LDEuODgsMC45OCAgYzAuMDQ3LDAuMDIyLDAuMDk1LDAuMDQyLDAuMTQyLDAuMDY0YzIuMDg5LDAuOTcxLDQuMzE5LDEuNjg0LDYuNjUxLDIuMTA1YzAuMDYxLDAuMDExLDAuMTIyLDAuMDIyLDAuMTg0LDAuMDMzICBjMC43MjQsMC4xMjUsMS40NTYsMC4yMjUsMi4xOTcsMC4yOTJjMC4wOSwwLjAwOCwwLjE4LDAuMDEzLDAuMjcxLDAuMDIxQzI1Ljk5OCw1NC45NjEsMjYuNzQ0LDU1LDI3LjUsNTUgIGMwLjc0OSwwLDEuNDg4LTAuMDM5LDIuMjIyLTAuMDk4YzAuMDkzLTAuMDA4LDAuMTg2LTAuMDEzLDAuMjc5LTAuMDIxYzAuNzM1LTAuMDY3LDEuNDYxLTAuMTY0LDIuMTc4LTAuMjg3ICBjMC4wNjItMC4wMTEsMC4xMjUtMC4wMjIsMC4xODctMC4wMzRjMi4yOTctMC40MTIsNC40OTUtMS4xMDksNi41NTctMi4wNTVjMC4wNzYtMC4wMzUsMC4xNTMtMC4wNjgsMC4yMjktMC4xMDQgIGMwLjYxNy0wLjI5LDEuMjItMC42MDMsMS44MTEtMC45MzZjMC4xNDctMC4wODMsMC4yOTMtMC4xNjcsMC40MzktMC4yNTNjMC41MzgtMC4zMTcsMS4wNjctMC42NDgsMS41ODEtMSAgYzAuMTg1LTAuMTI2LDAuMzY2LTAuMjU5LDAuNTQ5LTAuMzkxYzAuNDM5LTAuMzE2LDAuODctMC42NDIsMS4yODktMC45ODNjMC4wOTMtMC4wNzUsMC4xOTMtMC4xNCwwLjI4NC0wLjIxN2wwLjkxNS0wLjc2NCAgbC0wLjAyNy0wLjAyM0M1MS41MjMsNDIuODAyLDU1LDM1LjU1LDU1LDI3LjV6IE0yLDI3LjVDMiwxMy40MzksMTMuNDM5LDIsMjcuNSwyUzUzLDEzLjQzOSw1MywyNy41ICBjMCw3LjU3Ny0zLjMyNSwxNC4zODktOC41ODksMTkuMDYzYy0wLjI5NC0wLjIwMy0wLjU5LTAuMzg1LTAuODkzLTAuNTM3bC04LjQ2Ny00LjIzM2MtMC43Ni0wLjM4LTEuMjMyLTEuMTQ0LTEuMjMyLTEuOTkzdi0yLjk1NyAgYzAuMTk2LTAuMjQyLDAuNDAzLTAuNTE2LDAuNjE3LTAuODE3YzEuMDk2LTEuNTQ4LDEuOTc1LTMuMjcsMi42MTYtNS4xMjNjMS4yNjctMC42MDIsMi4wODUtMS44NjQsMi4wODUtMy4yODl2LTMuNTQ1ICBjMC0wLjg2Ny0wLjMxOC0xLjcwOC0wLjg4Ny0yLjM2OXYtNC42NjdjMC4wNTItMC41MTksMC4yMzYtMy40NDgtMS44ODMtNS44NjRDMzQuNTI0LDkuMDY1LDMxLjU0MSw4LDI3LjUsOCAgcy03LjAyNCwxLjA2NS04Ljg2NywzLjE2OGMtMi4xMTksMi40MTYtMS45MzUsNS4zNDUtMS44ODMsNS44NjR2NC42NjdjLTAuNTY4LDAuNjYxLTAuODg3LDEuNTAyLTAuODg3LDIuMzY5djMuNTQ1ICBjMCwxLjEwMSwwLjQ5NCwyLjEyOCwxLjM0LDIuODIxYzAuODEsMy4xNzMsMi40NzcsNS41NzUsMy4wOTMsNi4zODl2Mi44OTRjMCwwLjgxNi0wLjQ0NSwxLjU2Ni0xLjE2MiwxLjk1OGwtNy45MDcsNC4zMTMgIGMtMC4yNTIsMC4xMzctMC41MDIsMC4yOTctMC43NTIsMC40NzZDNS4yNzYsNDEuNzkyLDIsMzUuMDIyLDIsMjcuNXogTTQyLjQ1OSw0OC4xMzJjLTAuMzUsMC4yNTQtMC43MDYsMC41LTEuMDY3LDAuNzM1ICBjLTAuMTY2LDAuMTA4LTAuMzMxLDAuMjE2LTAuNSwwLjMyMWMtMC40NzIsMC4yOTItMC45NTIsMC41Ny0xLjQ0MiwwLjgzYy0wLjEwOCwwLjA1Ny0wLjIxNywwLjExMS0wLjMyNiwwLjE2NyAgYy0xLjEyNiwwLjU3Ny0yLjI5MSwxLjA3My0zLjQ4OCwxLjQ3NmMtMC4wNDIsMC4wMTQtMC4wODQsMC4wMjktMC4xMjcsMC4wNDNjLTAuNjI3LDAuMjA4LTEuMjYyLDAuMzkzLTEuOTA0LDAuNTUyICBjLTAuMDAyLDAtMC4wMDQsMC4wMDEtMC4wMDYsMC4wMDFjLTAuNjQ4LDAuMTYtMS4zMDQsMC4yOTMtMS45NjQsMC40MDJjLTAuMDE4LDAuMDAzLTAuMDM2LDAuMDA3LTAuMDU0LDAuMDEgIGMtMC42MjEsMC4xMDEtMS4yNDcsMC4xNzQtMS44NzUsMC4yMjljLTAuMTExLDAuMDEtMC4yMjIsMC4wMTctMC4zMzQsMC4wMjVDMjguNzUxLDUyLjk3LDI4LjEyNyw1MywyNy41LDUzICBjLTAuNjM0LDAtMS4yNjYtMC4wMzEtMS44OTUtMC4wNzhjLTAuMTA5LTAuMDA4LTAuMjE4LTAuMDE1LTAuMzI2LTAuMDI1Yy0wLjYzNC0wLjA1Ni0xLjI2NS0wLjEzMS0xLjg5LTAuMjMzICBjLTAuMDI4LTAuMDA1LTAuMDU2LTAuMDEtMC4wODQtMC4wMTVjLTEuMzIyLTAuMjIxLTIuNjIzLTAuNTQ2LTMuODktMC45NzFjLTAuMDM5LTAuMDEzLTAuMDc5LTAuMDI3LTAuMTE4LTAuMDQgIGMtMC42MjktMC4yMTQtMS4yNTEtMC40NTEtMS44NjItMC43MTNjLTAuMDA0LTAuMDAyLTAuMDA5LTAuMDA0LTAuMDEzLTAuMDA2Yy0wLjU3OC0wLjI0OS0xLjE0NS0wLjUyNS0xLjcwNS0wLjgxNiAgYy0wLjA3My0wLjAzOC0wLjE0Ny0wLjA3NC0wLjIxOS0wLjExM2MtMC41MTEtMC4yNzMtMS4wMTEtMC41NjgtMS41MDQtMC44NzZjLTAuMTQ2LTAuMDkyLTAuMjkxLTAuMTg1LTAuNDM1LTAuMjc5ICBjLTAuNDU0LTAuMjk3LTAuOTAyLTAuNjA2LTEuMzM4LTAuOTMzYy0wLjA0NS0wLjAzNC0wLjA4OC0wLjA3LTAuMTMzLTAuMTA0YzAuMDMyLTAuMDE4LDAuMDY0LTAuMDM2LDAuMDk2LTAuMDU0bDcuOTA3LTQuMzEzICBjMS4zNi0wLjc0MiwyLjIwNS0yLjE2NSwyLjIwNS0zLjcxNGwtMC4wMDEtMy42MDJsLTAuMjMtMC4yNzhjLTAuMDIyLTAuMDI1LTIuMTg0LTIuNjU1LTMuMDAxLTYuMjE2bC0wLjA5MS0wLjM5NmwtMC4zNDEtMC4yMjEgIGMtMC40ODEtMC4zMTEtMC43NjktMC44MzEtMC43NjktMS4zOTJ2LTMuNTQ1YzAtMC40NjUsMC4xOTctMC44OTgsMC41NTctMS4yMjNsMC4zMy0wLjI5OHYtNS41N2wtMC4wMDktMC4xMzEgIGMtMC4wMDMtMC4wMjQtMC4yOTgtMi40MjksMS4zOTYtNC4zNkMyMS41ODMsMTAuODM3LDI0LjA2MSwxMCwyNy41LDEwYzMuNDI2LDAsNS44OTYsMC44Myw3LjM0NiwyLjQ2NiAgYzEuNjkyLDEuOTExLDEuNDE1LDQuMzYxLDEuNDEzLDQuMzgxbC0wLjAwOSw1LjcwMWwwLjMzLDAuMjk4YzAuMzU5LDAuMzI0LDAuNTU3LDAuNzU4LDAuNTU3LDEuMjIzdjMuNTQ1ICBjMCwwLjcxMy0wLjQ4NSwxLjM2LTEuMTgxLDEuNTc1bC0wLjQ5NywwLjE1M2wtMC4xNiwwLjQ5NWMtMC41OSwxLjgzMy0xLjQzLDMuNTI2LTIuNDk2LDUuMDMyYy0wLjI2MiwwLjM3LTAuNTE3LDAuNjk4LTAuNzM2LDAuOTQ5ICBsLTAuMjQ4LDAuMjgzVjM5LjhjMCwxLjYxMiwwLjg5NiwzLjA2MiwyLjMzOCwzLjc4Mmw4LjQ2Nyw0LjIzM2MwLjA1NCwwLjAyNywwLjEwNywwLjA1NSwwLjE2LDAuMDgzICBDNDIuNjc3LDQ3Ljk3OSw0Mi41NjcsNDguMDU0LDQyLjQ1OSw0OC4xMzJ6IiBmaWxsPSIjODc4Nzg3Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=">{{ capacity_basic_value }} + {{ capacity_additional_value }}
            </span>
            <span class="flex items-center w-1/2">
                <img class="mr-2 w-px-24" style="width:20px" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDIyNy42MzYgMjI3LjYzNiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjI3LjYzNiAyMjcuNjM2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggZD0iTTIyMy4wNjEsMEg0LjU3NUMyLjA0OSwwLDAuMDAxLDIuMDQ4LDAuMDAxLDQuNTc0djIxOC40ODhjMCwyLjUyNiwyLjA0OCw0LjU3NCw0LjU3NCw0LjU3NEgxMzcuODMgIGMyLjUyNiwwLDQuNTczLTIuMDQ4LDQuNTczLTQuNTc0YzAtMi41MjYtMi4wNDctNC41NzQtNC41NzMtNC41NzRIOS4xNDlWMTExLjg4MWg2My43OTh2NDMuODQ5YzAsMi41MjYsMi4wNDgsNC41NzQsNC41NzQsNC41NzQgIGMyLjUyNiwwLDQuNTc0LTIuMDQ4LDQuNTc0LTQuNTc0VjU5Ljk2YzAtMi41MjYtMi4wNDgtNC41NzQtNC41NzQtNC41NzRjLTIuNTI2LDAtNC41NzQsMi4wNDgtNC41NzQsNC41NzR2NDIuNzczSDkuMTQ5VjkuMTQ4ICBoMTI0LjEwOHY1Ny4yNzFjMCwyLjUyNiwyLjA0Nyw0LjU3NCw0LjU3Myw0LjU3NGg0OC4zNzJjMi41MjYsMCw0LjU3My0yLjA0OCw0LjU3My00LjU3NGMwLTIuNTI2LTIuMDQ3LTQuNTc0LTQuNTczLTQuNTc0aC00My43OTkgIFY5LjE0OGg3Ni4wODV2MTQyLjAwOUgxMzcuODNjLTIuNTI2LDAtNC41NzMsMi4wNDgtNC41NzMsNC41NzRjMCwyLjUyNiwyLjA0Nyw0LjU3NCw0LjU3Myw0LjU3NGg4MC42NTh2NTguMTg1aC0zMi4yODYgIGMtMi41MjYsMC00LjU3MywyLjA0OC00LjU3Myw0LjU3NGMwLDIuNTI2LDIuMDQ3LDQuNTc0LDQuNTczLDQuNTc0aDM2Ljg1OWMyLjUyNiwwLDQuNTczLTIuMDQ4LDQuNTczLTQuNTc0VjQuNTc0ICBDMjI3LjYzNSwyLjA0OCwyMjUuNTg4LDAsMjIzLjA2MSwweiIgZmlsbD0iIzg3ODc4NyIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K"> {{ floor_size }} m<sup>2</sup>
            </span>        
        </div>
		<a href="{{ link }}">
            <div class="border-t pt-4 pb-4 text-center text-base text-gray-800 uppercase tracking-widest group-hover:text-gray-900 bg-gray-50 group-hover:bg-gray-70">
                {{ book_title }}
            </div>
        </a>
    </section>	
</div>', 'style' => '/* ' . mb_strtoupper($type) . ' */'
                    ];
                case 'realestate':
                    return [
                        'template' => '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
	<a href="" class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
		<div class="relative pb-48 overflow-hidden">
			<img class="absolute inset-0 h-full w-full object-cover" src="{{ image_url }}" alt="{{ title }}">
		</div>
	</a>
	<div class="p-4">
        <span class="inline-block px-2 py-1 leading-none bg-gray-300 text-white rounded-full font-semibold uppercase tracking-wide text-xs">{{ property_title }}</span>
        <h2 class="mt-2 mb-2  font-bold">{{ title }}</h2>
        <p class="text-sm h-24 overflow-ellipsis overflow-hidden">{{ description }}</p>
        <div class="mt-3 flex items-center">
            <span class="text-sm font-semibold"></span> <span class="font-bold text-xl">{{ price }}</span> <span class="text-sm font-semibold">{{ currency }}</span>
        </div>
    </div>
    <div class="flex p-4 border-t border-b text-sm text-gray-800">
        <span class="flex items-center mb-1 w-1/2">
            <i class="fas fa-home mr-2 w-px-24"></i>{{ capacity_basic_value }} + {{ capacity_additional_value }}
        </span>
        <span class="flex items-center w-1/2">
            <i class="fas fa-home mr-2 w-px-24"></i> {{ floor_size }} m<sup>2</sup>
        </span>        
    </div>      
    <div class="flex p-4 border-t border-b text-xs text-gray-700">
        <a href="{{ link }}" class="w-full block text-center px-6 py-2 text-gray-700 border-2 border-gray-500 hover:bg-gray-500 hover:text-white">{{ book_title }}</a>
    </div>
</div>', 'style' => '/* ' . mb_strtoupper($type) . ' */'
                    ];
                case 'floating':
                    return [
                        'template' => '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-2">
	<div class="wrapper antialiased text-gray-900">
		<div>    
			<div class="h-96 w-full overflow-hidden object-cover object-center rounded-lg shadow-md">
				<div class="w-full h-full bg-cover" style="background-image:url({{ image_url }})" alt="{{ title }}"></div>
			</div>
			<div class="relative px-4 -mt-16">
				<div class="bg-white p-6 rounded-lg shadow-lg">
					<h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">{{ title }}</h4>
					<div class="flex items-baseline">
						<div class="text-gray-600 uppercase text-xs font-semibold tracking-wider">
							{{ capacity_basic_value }} {{ capacity_basic_title }}, {{ capacity_additional_value }} {{ capacity_additional_title }}
						</div>  
					</div>
					<div class="mt-1">{{ price }} <span class="text-gray-600 text-sm">{{ currency }}</span></div>					
					<div class="px-6 py-4">
			<a href="{{ link }}" class="w-full block text-center px-6 py-2 text-gray-700 border-2 border-gray-500 hover:bg-gray-500 hover:text-indigo-100">{{ book_title }}</a>
		</div>
				</div>				
			</div>
		</div>
	</div>
</div>', 'style' => '/* ' . mb_strtoupper($type) . ' */'
                    ];
                case 'travel':
                    return [
                        'template' => '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-2">
	<article class="mx-auto group w-full shadow-2xl max-w-md pb-8 rounded-b-2xl transform duration-500 hover:-translate-y-2 cursor-pointer">
		<section class="content bg-cover bg-center h-64 rounded-2xl" style="background-image: url({{ image_url }});">
			<div class="flex items-end w-full h-full bg-black bg-opacity-20 text-white text-sm font-bold  p-4 rounded-2xl">
				<div class="w-1/2 flex items-center flex-row-reverse">
					<span class="place-items-end">{{ price }} {{ currency }}</span>
				</div>
			</div>
		</section>                
		<div class="mt-4 px-4">
			<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="rgba(0,0,0,0.6)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
			</svg>
			<h4 class="mt-4 text-base font-medium text-gray-400">{{ property_title }}</h4>
			<p class="mt-2 text-2xl text-gray-700">{{ title }}</p>
		</div>
	</article>
</div>', 'style' => '/* ' . mb_strtoupper($type) . ' */'
                    ];
                case 'darkImage':
                    return [
                        'template' => '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-2">
	<article class="h-96 bg-orange-600 max-w-xl w-full rounded-xl text-gray-100 bg-cover bg-center transform duration-500 hover:-translate-y-1 cursor-pointer" style="background-image: url({{ image_url }});">
		<div class="bg-black bg-opacity-60 p-10 rounded-xl h-full">			
			<div class="mt-20">
				<span class="font-bold text-xl">{{ title }}</span>
			</div>
			<div class="mt-32 flex justify-between ">
				<span class="p-3 pl-0 font-bold">{{ price }} {{ currency }}</span>
				<a href="{{ link }}">
					<span class="p-3 border-2 border-gray-200 rounded-md text-white hover:bg-gray-200 hover:border-gray-200 cursor-pointer hover:text-black ">{{ book_title }}</span>
				</a>
			</div>
		</div>
	</article>
</div>', 'style' => '/* ' . mb_strtoupper($type) . ' */'
                    ];
                case 'trata':
                    return [
                        'template' => '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
	<div class="c-card block bg-white overflow-hidden">
		<a href="{{ link }}">
      		<div class="bentral-image-placeholder relative pb-48 overflow-hidden">
				<div class="absolute inset-0 h-full w-full bg-cover bentral-image" style="background-image:linear-gradient(to bottom, rgba(28, 28, 28, 0) 50%,rgb(28 28 28) 100%),url({{ image_url }})" alt="{{ title }}">					
				</div>
				<div class="bentral-property-title-div">
					<div class="bentral-property-title float-left mr-1">{{ property_title }}</div> 
					<div class="bentral-star float-left mr-1"></div>
					<div class="bentral-star float-left mr-1"></div>
					<div class="bentral-star float-left mr-1"></div>
				</div>
			</div>
		</a>
		<div class="bentral-card-body">
			<a href="{{ link }}">
				<h1 class="bentral-title">{{ title }}</h1>
			</a>
			<div class="bentral-booking-section">
				<div class="bentral-booking block float-left w-full">
                	<div class="bentral-people"></div>
                    <p class="bentral-text uppercase">{{ capacity_basic_value }} + {{ capacity_additional_value }} {{ capacity_basic_title }}</p>
                    <div class="bentral-floor"></div>
                    <p class="bentral-text">{{ floor_size }} m²</p>
				</div>
				<div class="bentral-booking-intro block float-left w-full mt-2">{{ intro_text }}</div>
				<a href="{{ link }}" class="bentral-book bg-transparent border-gray-700 hover:border-gray-900 text-gray-500 font-semibold py-2 px-4 border w-full pb-3">{{ book_title }}</a>
			</div>
		</div>
	</div>	
</div>', 'style' => '/* ' . mb_strtoupper($type) . ' */
.bentral-search-results .btn-book {
    background: #c32827!important;
}

.bentral-search-results .capacity{
	font-size: 0.9em;
}

.bentral-search-results .c-card.block{
	border: 1px solid #f1f1f1;
}

.bentral-search-results .bentral-image{
    padding: 30px;
    height: 240px;
}

.bentral-search-results .bentral-card-body{
    padding: 30px;
}

.bentral-search-results .bentral-card-body .bentral-title{
	color: #1c1c1d;
	font-family: \'Gilda Display\', sans-serif;
	font-weight: 400;
	font-size: 30px;
    line-height: 30px;
	margin: 0 0 10px 0;
    padding: 0px;
}

.bentral-search-results .bentral-card-body .bentral-booking-section{
	float: left;
	width: 100%;
}

.bentral-search-results .bentral-card-body .bentral-booking{
	display: table;
	float: left;
}

.bentral-search-results .bentral-card-body .bentral-booking-intro{
	padding: 15px 0!important;
	color: #878788!important;
	font-family: \'Roboto\', sans-serif!important;
	font-weight: 400;
	font-size: 14px!important;
    line-height: 27px!important;
    min-height: 130px;
	overflow: hidden;
}

.bentral-search-results .bentral-card-body .bentral-book{
	width: 100%;
    display: inline-block;
    text-align: center;
    padding: 10px 30px;
    margin-bottom: 20px;
}

.bentral-search-results .bentral-card-body .bentral-text {
	color: #878788;
	font-family: \'Roboto\', sans-serif;
	vertical-align: middle;
	display: table-cell;
	font-size: 12px;
    line-height: 12px;
    font-weight: 400;
	padding-right: 15px;
}

.bentral-search-results .bentral-property-title-div {
    position: absolute;
    bottom: 20px;
    left: 20px;
    width: 100%;
    display: block;
}

.bentral-search-results .bentral-property-title{
	font-family: \'Roboto\', sans-serif;
	color: #fff !important;
	text-transform: uppercase;
	letter-spacing: 2px;
	font-size: 11px;
    line-height: 11px;
	margin-right: 10px;
    font-weight: 400;
}

.bentral-search-results .c-card .bentral-image{
	height: 240px;
}

.bentral-search-results .bentral-star{
	width:10px;
	height:10px;
  background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4yLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4KCjxzdmcKICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIgogICB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiCiAgIHhtbG5zOnN2Zz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgeG1sbnM6c29kaXBvZGk9Imh0dHA6Ly9zb2RpcG9kaS5zb3VyY2Vmb3JnZS5uZXQvRFREL3NvZGlwb2RpLTAuZHRkIgogICB4bWxuczppbmtzY2FwZT0iaHR0cDovL3d3dy5pbmtzY2FwZS5vcmcvbmFtZXNwYWNlcy9pbmtzY2FwZSIKICAgdmVyc2lvbj0iMS4xIgogICBpZD0iQ2FwYV8xIgogICB4PSIwcHgiCiAgIHk9IjBweCIKICAgdmlld0JveD0iMCAwIDUxMiA1MTIiCiAgIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IgogICB4bWw6c3BhY2U9InByZXNlcnZlIgogICBpbmtzY2FwZTp2ZXJzaW9uPSIwLjkxIHIxMzcyNSIKICAgc29kaXBvZGk6ZG9jbmFtZT0iaWNvbi1zdGFyLWZ1bGwtd2hpdGUuc3ZnIj48bWV0YWRhdGEKICAgICBpZD0ibWV0YWRhdGExMyI+PHJkZjpSREY+PGNjOldvcmsKICAgICAgICAgcmRmOmFib3V0PSIiPjxkYzpmb3JtYXQ+aW1hZ2Uvc3ZnK3htbDwvZGM6Zm9ybWF0PjxkYzp0eXBlCiAgICAgICAgICAgcmRmOnJlc291cmNlPSJodHRwOi8vcHVybC5vcmcvZGMvZGNtaXR5cGUvU3RpbGxJbWFnZSIgLz48ZGM6dGl0bGU+PC9kYzp0aXRsZT48L2NjOldvcms+PC9yZGY6UkRGPjwvbWV0YWRhdGE+PGRlZnMKICAgICBpZD0iZGVmczExIiAvPjxzb2RpcG9kaTpuYW1lZHZpZXcKICAgICBwYWdlY29sb3I9IiNmZmZmZmYiCiAgICAgYm9yZGVyY29sb3I9IiM2NjY2NjYiCiAgICAgYm9yZGVyb3BhY2l0eT0iMSIKICAgICBvYmplY3R0b2xlcmFuY2U9IjEwIgogICAgIGdyaWR0b2xlcmFuY2U9IjEwIgogICAgIGd1aWRldG9sZXJhbmNlPSIxMCIKICAgICBpbmtzY2FwZTpwYWdlb3BhY2l0eT0iMCIKICAgICBpbmtzY2FwZTpwYWdlc2hhZG93PSIyIgogICAgIGlua3NjYXBlOndpbmRvdy13aWR0aD0iMTM2MiIKICAgICBpbmtzY2FwZTp3aW5kb3ctaGVpZ2h0PSI2ODgiCiAgICAgaWQ9Im5hbWVkdmlldzkiCiAgICAgc2hvd2dyaWQ9ImZhbHNlIgogICAgIGlua3NjYXBlOnpvb209IjAuNDYwOTM3NSIKICAgICBpbmtzY2FwZTpjeD0iMjU2IgogICAgIGlua3NjYXBlOmN5PSIyNTYiCiAgICAgaW5rc2NhcGU6d2luZG93LXg9IjAiCiAgICAgaW5rc2NhcGU6d2luZG93LXk9IjIzIgogICAgIGlua3NjYXBlOndpbmRvdy1tYXhpbWl6ZWQ9IjAiCiAgICAgaW5rc2NhcGU6Y3VycmVudC1sYXllcj0iQ2FwYV8xIiAvPjxzdHlsZQogICAgIHR5cGU9InRleHQvY3NzIgogICAgIGlkPSJzdHlsZTMiPgoJLnN0MHtmaWxsOiNBM0EzQTM7fQo8L3N0eWxlPjxnCiAgICAgaWQ9Imc1IgogICAgIHN0eWxlPSJmaWxsOiNmZmZmZmY7ZmlsbC1vcGFjaXR5OjAuOTQxMTc2NDciPjxwYXRoCiAgICAgICBjbGFzcz0ic3QwIgogICAgICAgZD0iTTUxMS40LDE5Ny40Yy0xLjgtNS41LTYuOS05LjEtMTIuNi05LjFIMzIyLjlMMjY4LjYsMjFjLTEuOC01LjUtNi45LTkuMS0xMi42LTkuMWMtNS43LDAtMTAuOCwzLjctMTIuNiw5LjEgICBsLTU0LjMsMTY3LjJIMTMuMmMtNS43LDAtMTAuOCwzLjctMTIuNiw5LjFjLTEuOCw1LjUsMC4yLDExLjQsNC44LDE0LjhsMTQyLjMsMTAzLjRMOTMuNCw0ODIuOGMtMS44LDUuNSwwLjIsMTEuNCw0LjgsMTQuOCAgIGM0LjYsMy40LDEwLjksMy40LDE1LjYsMEwyNTYsMzk0LjJsMTQyLjMsMTAzLjRjMi4zLDEuNyw1LjEsMi41LDcuOCwyLjVjMi43LDAsNS41LTAuOCw3LjgtMi41YzQuNi0zLjQsNi42LTkuMyw0LjgtMTQuOCAgIGwtNTQuMy0xNjcuMmwxNDIuMi0xMDMuNEM1MTEuMiwyMDguOCw1MTMuMSwyMDIuOSw1MTEuNCwxOTcuNHoiCiAgICAgICBpZD0icGF0aDciCiAgICAgICBzdHlsZT0iZmlsbDojZmZmZmZmO2ZpbGwtb3BhY2l0eTowLjk0MTE3NjQ3IiAvPjwvZz48L3N2Zz4=")
}

.bentral-search-results .bentral-people {
	width: 23px;
	height: 23px;
	float: left;
    background-size: contain;
	margin-right: 10px;
  background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU1IDU1IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1NSA1NTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIGQ9Ik01NSwyNy41QzU1LDEyLjMzNyw0Mi42NjMsMCwyNy41LDBTMCwxMi4zMzcsMCwyNy41YzAsOC4wMDksMy40NDQsMTUuMjI4LDguOTI2LDIwLjI1OGwtMC4wMjYsMC4wMjNsMC44OTIsMC43NTIgIGMwLjA1OCwwLjA0OSwwLjEyMSwwLjA4OSwwLjE3OSwwLjEzN2MwLjQ3NCwwLjM5MywwLjk2NSwwLjc2NiwxLjQ2NSwxLjEyN2MwLjE2MiwwLjExNywwLjMyNCwwLjIzNCwwLjQ4OSwwLjM0OCAgYzAuNTM0LDAuMzY4LDEuMDgyLDAuNzE3LDEuNjQyLDEuMDQ4YzAuMTIyLDAuMDcyLDAuMjQ1LDAuMTQyLDAuMzY4LDAuMjEyYzAuNjEzLDAuMzQ5LDEuMjM5LDAuNjc4LDEuODgsMC45OCAgYzAuMDQ3LDAuMDIyLDAuMDk1LDAuMDQyLDAuMTQyLDAuMDY0YzIuMDg5LDAuOTcxLDQuMzE5LDEuNjg0LDYuNjUxLDIuMTA1YzAuMDYxLDAuMDExLDAuMTIyLDAuMDIyLDAuMTg0LDAuMDMzICBjMC43MjQsMC4xMjUsMS40NTYsMC4yMjUsMi4xOTcsMC4yOTJjMC4wOSwwLjAwOCwwLjE4LDAuMDEzLDAuMjcxLDAuMDIxQzI1Ljk5OCw1NC45NjEsMjYuNzQ0LDU1LDI3LjUsNTUgIGMwLjc0OSwwLDEuNDg4LTAuMDM5LDIuMjIyLTAuMDk4YzAuMDkzLTAuMDA4LDAuMTg2LTAuMDEzLDAuMjc5LTAuMDIxYzAuNzM1LTAuMDY3LDEuNDYxLTAuMTY0LDIuMTc4LTAuMjg3ICBjMC4wNjItMC4wMTEsMC4xMjUtMC4wMjIsMC4xODctMC4wMzRjMi4yOTctMC40MTIsNC40OTUtMS4xMDksNi41NTctMi4wNTVjMC4wNzYtMC4wMzUsMC4xNTMtMC4wNjgsMC4yMjktMC4xMDQgIGMwLjYxNy0wLjI5LDEuMjItMC42MDMsMS44MTEtMC45MzZjMC4xNDctMC4wODMsMC4yOTMtMC4xNjcsMC40MzktMC4yNTNjMC41MzgtMC4zMTcsMS4wNjctMC42NDgsMS41ODEtMSAgYzAuMTg1LTAuMTI2LDAuMzY2LTAuMjU5LDAuNTQ5LTAuMzkxYzAuNDM5LTAuMzE2LDAuODctMC42NDIsMS4yODktMC45ODNjMC4wOTMtMC4wNzUsMC4xOTMtMC4xNCwwLjI4NC0wLjIxN2wwLjkxNS0wLjc2NCAgbC0wLjAyNy0wLjAyM0M1MS41MjMsNDIuODAyLDU1LDM1LjU1LDU1LDI3LjV6IE0yLDI3LjVDMiwxMy40MzksMTMuNDM5LDIsMjcuNSwyUzUzLDEzLjQzOSw1MywyNy41ICBjMCw3LjU3Ny0zLjMyNSwxNC4zODktOC41ODksMTkuMDYzYy0wLjI5NC0wLjIwMy0wLjU5LTAuMzg1LTAuODkzLTAuNTM3bC04LjQ2Ny00LjIzM2MtMC43Ni0wLjM4LTEuMjMyLTEuMTQ0LTEuMjMyLTEuOTkzdi0yLjk1NyAgYzAuMTk2LTAuMjQyLDAuNDAzLTAuNTE2LDAuNjE3LTAuODE3YzEuMDk2LTEuNTQ4LDEuOTc1LTMuMjcsMi42MTYtNS4xMjNjMS4yNjctMC42MDIsMi4wODUtMS44NjQsMi4wODUtMy4yODl2LTMuNTQ1ICBjMC0wLjg2Ny0wLjMxOC0xLjcwOC0wLjg4Ny0yLjM2OXYtNC42NjdjMC4wNTItMC41MTksMC4yMzYtMy40NDgtMS44ODMtNS44NjRDMzQuNTI0LDkuMDY1LDMxLjU0MSw4LDI3LjUsOCAgcy03LjAyNCwxLjA2NS04Ljg2NywzLjE2OGMtMi4xMTksMi40MTYtMS45MzUsNS4zNDUtMS44ODMsNS44NjR2NC42NjdjLTAuNTY4LDAuNjYxLTAuODg3LDEuNTAyLTAuODg3LDIuMzY5djMuNTQ1ICBjMCwxLjEwMSwwLjQ5NCwyLjEyOCwxLjM0LDIuODIxYzAuODEsMy4xNzMsMi40NzcsNS41NzUsMy4wOTMsNi4zODl2Mi44OTRjMCwwLjgxNi0wLjQ0NSwxLjU2Ni0xLjE2MiwxLjk1OGwtNy45MDcsNC4zMTMgIGMtMC4yNTIsMC4xMzctMC41MDIsMC4yOTctMC43NTIsMC40NzZDNS4yNzYsNDEuNzkyLDIsMzUuMDIyLDIsMjcuNXogTTQyLjQ1OSw0OC4xMzJjLTAuMzUsMC4yNTQtMC43MDYsMC41LTEuMDY3LDAuNzM1ICBjLTAuMTY2LDAuMTA4LTAuMzMxLDAuMjE2LTAuNSwwLjMyMWMtMC40NzIsMC4yOTItMC45NTIsMC41Ny0xLjQ0MiwwLjgzYy0wLjEwOCwwLjA1Ny0wLjIxNywwLjExMS0wLjMyNiwwLjE2NyAgYy0xLjEyNiwwLjU3Ny0yLjI5MSwxLjA3My0zLjQ4OCwxLjQ3NmMtMC4wNDIsMC4wMTQtMC4wODQsMC4wMjktMC4xMjcsMC4wNDNjLTAuNjI3LDAuMjA4LTEuMjYyLDAuMzkzLTEuOTA0LDAuNTUyICBjLTAuMDAyLDAtMC4wMDQsMC4wMDEtMC4wMDYsMC4wMDFjLTAuNjQ4LDAuMTYtMS4zMDQsMC4yOTMtMS45NjQsMC40MDJjLTAuMDE4LDAuMDAzLTAuMDM2LDAuMDA3LTAuMDU0LDAuMDEgIGMtMC42MjEsMC4xMDEtMS4yNDcsMC4xNzQtMS44NzUsMC4yMjljLTAuMTExLDAuMDEtMC4yMjIsMC4wMTctMC4zMzQsMC4wMjVDMjguNzUxLDUyLjk3LDI4LjEyNyw1MywyNy41LDUzICBjLTAuNjM0LDAtMS4yNjYtMC4wMzEtMS44OTUtMC4wNzhjLTAuMTA5LTAuMDA4LTAuMjE4LTAuMDE1LTAuMzI2LTAuMDI1Yy0wLjYzNC0wLjA1Ni0xLjI2NS0wLjEzMS0xLjg5LTAuMjMzICBjLTAuMDI4LTAuMDA1LTAuMDU2LTAuMDEtMC4wODQtMC4wMTVjLTEuMzIyLTAuMjIxLTIuNjIzLTAuNTQ2LTMuODktMC45NzFjLTAuMDM5LTAuMDEzLTAuMDc5LTAuMDI3LTAuMTE4LTAuMDQgIGMtMC42MjktMC4yMTQtMS4yNTEtMC40NTEtMS44NjItMC43MTNjLTAuMDA0LTAuMDAyLTAuMDA5LTAuMDA0LTAuMDEzLTAuMDA2Yy0wLjU3OC0wLjI0OS0xLjE0NS0wLjUyNS0xLjcwNS0wLjgxNiAgYy0wLjA3My0wLjAzOC0wLjE0Ny0wLjA3NC0wLjIxOS0wLjExM2MtMC41MTEtMC4yNzMtMS4wMTEtMC41NjgtMS41MDQtMC44NzZjLTAuMTQ2LTAuMDkyLTAuMjkxLTAuMTg1LTAuNDM1LTAuMjc5ICBjLTAuNDU0LTAuMjk3LTAuOTAyLTAuNjA2LTEuMzM4LTAuOTMzYy0wLjA0NS0wLjAzNC0wLjA4OC0wLjA3LTAuMTMzLTAuMTA0YzAuMDMyLTAuMDE4LDAuMDY0LTAuMDM2LDAuMDk2LTAuMDU0bDcuOTA3LTQuMzEzICBjMS4zNi0wLjc0MiwyLjIwNS0yLjE2NSwyLjIwNS0zLjcxNGwtMC4wMDEtMy42MDJsLTAuMjMtMC4yNzhjLTAuMDIyLTAuMDI1LTIuMTg0LTIuNjU1LTMuMDAxLTYuMjE2bC0wLjA5MS0wLjM5NmwtMC4zNDEtMC4yMjEgIGMtMC40ODEtMC4zMTEtMC43NjktMC44MzEtMC43NjktMS4zOTJ2LTMuNTQ1YzAtMC40NjUsMC4xOTctMC44OTgsMC41NTctMS4yMjNsMC4zMy0wLjI5OHYtNS41N2wtMC4wMDktMC4xMzEgIGMtMC4wMDMtMC4wMjQtMC4yOTgtMi40MjksMS4zOTYtNC4zNkMyMS41ODMsMTAuODM3LDI0LjA2MSwxMCwyNy41LDEwYzMuNDI2LDAsNS44OTYsMC44Myw3LjM0NiwyLjQ2NiAgYzEuNjkyLDEuOTExLDEuNDE1LDQuMzYxLDEuNDEzLDQuMzgxbC0wLjAwOSw1LjcwMWwwLjMzLDAuMjk4YzAuMzU5LDAuMzI0LDAuNTU3LDAuNzU4LDAuNTU3LDEuMjIzdjMuNTQ1ICBjMCwwLjcxMy0wLjQ4NSwxLjM2LTEuMTgxLDEuNTc1bC0wLjQ5NywwLjE1M2wtMC4xNiwwLjQ5NWMtMC41OSwxLjgzMy0xLjQzLDMuNTI2LTIuNDk2LDUuMDMyYy0wLjI2MiwwLjM3LTAuNTE3LDAuNjk4LTAuNzM2LDAuOTQ5ICBsLTAuMjQ4LDAuMjgzVjM5LjhjMCwxLjYxMiwwLjg5NiwzLjA2MiwyLjMzOCwzLjc4Mmw4LjQ2Nyw0LjIzM2MwLjA1NCwwLjAyNywwLjEwNywwLjA1NSwwLjE2LDAuMDgzICBDNDIuNjc3LDQ3Ljk3OSw0Mi41NjcsNDguMDU0LDQyLjQ1OSw0OC4xMzJ6IiBmaWxsPSIjODc4Nzg3Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=")
}

.bentral-search-results .bentral-floor {
	width: 23px;
	height: 23px;
	float: left;
    background-size: contain;
	margin-right: 10px;
  background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDIyNy42MzYgMjI3LjYzNiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjI3LjYzNiAyMjcuNjM2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggZD0iTTIyMy4wNjEsMEg0LjU3NUMyLjA0OSwwLDAuMDAxLDIuMDQ4LDAuMDAxLDQuNTc0djIxOC40ODhjMCwyLjUyNiwyLjA0OCw0LjU3NCw0LjU3NCw0LjU3NEgxMzcuODMgIGMyLjUyNiwwLDQuNTczLTIuMDQ4LDQuNTczLTQuNTc0YzAtMi41MjYtMi4wNDctNC41NzQtNC41NzMtNC41NzRIOS4xNDlWMTExLjg4MWg2My43OTh2NDMuODQ5YzAsMi41MjYsMi4wNDgsNC41NzQsNC41NzQsNC41NzQgIGMyLjUyNiwwLDQuNTc0LTIuMDQ4LDQuNTc0LTQuNTc0VjU5Ljk2YzAtMi41MjYtMi4wNDgtNC41NzQtNC41NzQtNC41NzRjLTIuNTI2LDAtNC41NzQsMi4wNDgtNC41NzQsNC41NzR2NDIuNzczSDkuMTQ5VjkuMTQ4ICBoMTI0LjEwOHY1Ny4yNzFjMCwyLjUyNiwyLjA0Nyw0LjU3NCw0LjU3Myw0LjU3NGg0OC4zNzJjMi41MjYsMCw0LjU3My0yLjA0OCw0LjU3My00LjU3NGMwLTIuNTI2LTIuMDQ3LTQuNTc0LTQuNTczLTQuNTc0aC00My43OTkgIFY5LjE0OGg3Ni4wODV2MTQyLjAwOUgxMzcuODNjLTIuNTI2LDAtNC41NzMsMi4wNDgtNC41NzMsNC41NzRjMCwyLjUyNiwyLjA0Nyw0LjU3NCw0LjU3Myw0LjU3NGg4MC42NTh2NTguMTg1aC0zMi4yODYgIGMtMi41MjYsMC00LjU3MywyLjA0OC00LjU3Myw0LjU3NGMwLDIuNTI2LDIuMDQ3LDQuNTc0LDQuNTczLDQuNTc0aDM2Ljg1OWMyLjUyNiwwLDQuNTczLTIuMDQ4LDQuNTczLTQuNTc0VjQuNTc0ICBDMjI3LjYzNSwyLjA0OCwyMjUuNTg4LDAsMjIzLjA2MSwweiIgZmlsbD0iIzg3ODc4NyIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K")
}'];
                case 'jasna':
                return [
                    'template' => '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
	<div class="c-card block bg-white overflow-hidden">
		<a href="{{ link }}">
      		<div class="bentral-image-placeholder relative pb-48 overflow-hidden">
				<div class="absolute inset-0 h-full w-full bg-cover bentral-image" style="background-image:linear-gradient(to bottom, rgba(28, 28, 28, 0) 50%,rgb(28 28 28) 100%),url({{ image_url }})" alt="{{ title }}">	
					<div class="bentral-property-price-div">
						<div class="bentral-price">{{ price }} {{ currency }}</div> 
					</div>
				</div>
				<div class="bentral-property-title-div">
					<div class="bentral-property-title float-left mr-1">{{ property_title }}</div>
				</div>
			</div>
		</a>
		<div class="bentral-card-body">
			<a href="{{ link }}">
				<h1 class="bentral-title">{{ title }}</h1>
			</a>
			<div class="bentral-booking-section">
				<div class="bentral-booking block float-left w-full">
                	<div class="bentral-people"></div>
                    <p class="bentral-text uppercase">{{ capacity_basic_value }} + {{ capacity_additional_value }} {{ capacity_basic_title }}</p>
                    <div class="bentral-floor"></div>
                    <p class="bentral-text">{{ floor_size }} m²</p>
				</div>
				<a href="{{ link }}" class="bentral-book mt-6 font-semibold py-2 px-4 border w-full pb-3">{{ book_title }}</a>
			</div>
		</div>
	</div>	
</div>', 'style' => '/* ' . mb_strtoupper($type) . ' */
.bentral-search-results {
    display: flex;
    align-items: center;
    justify-content: center;
}

.bentral-search-results .bentral-book {
    color: #fff!important;
    background: #c89350!important;
    border: 0!important;
}

.bentral-search-results .bentral-book:hover {
    background-color: #000!important;
}

.bentral-search-results .capacity{
	font-size: 0.9em;
}

.bentral-search-results .c-card.block {
    border: 0;
    box-shadow: 1px 1px 5px 0px rgb(0 0 0 / 30%);
}

.bentral-search-results .bentral-image{
    padding: 30px;
    height: 240px;
}

.bentral-search-results .bentral-card-body{
    padding: 0 30px 30px 30px;
}


.bentral-search-results .bentral-price {
    background: rgb(28 28 28 / 70%);
    padding: 5px 10px;
    width: 120px;
    text-align: center;
    color: #fff;
    font-size: 17px;
    font-weight: 600;
    text-transform: uppercase;
    float: right;
    margin-right: -31px;
}

.bentral-search-results .bentral-card-body .bentral-title {
    margin: 0;
	color: #1c1c1d;
    font-weight: 400;
    font-size: 20px;
    line-height: 34px;
    padding: 5px 10px;
    text-align: center;
    height: 50px;
}
.bentral-search-results .bentral-card-body .bentral-booking-section{
	float: left;
	width: 100%;
}

.bentral-search-results .bentral-card-body .bentral-booking{
	display: table;
	float: left;
}

.bentral-search-results .bentral-card-body .bentral-book{
	width: 100%;
    display: inline-block;
    text-align: center;
    padding: 10px 30px;
    margin-bottom: 20px;
}

.bentral-search-results .bentral-card-body .bentral-text {
	color: #878788;
	vertical-align: middle;
	display: table-cell;
	font-size: 12px;
    line-height: 12px;
    font-weight: 400;
	padding-right: 15px;
}

.bentral-search-results .bentral-property-title-div {
    position: absolute;
    bottom: 20px;
    left: 20px;
    width: 100%;
    display: block;
}

.bentral-search-results .bentral-property-title{
	color: #fff !important;
	text-transform: uppercase;
	letter-spacing: 2px;
	font-size: 11px;
    line-height: 11px;
	margin-right: 10px;
    font-weight: 400;
}

.bentral-search-results .c-card .bentral-image{
	height: 240px;
}

.bentral-search-results .bentral-people {
	width: 23px;
	height: 23px;
	float: right;
    background-size: contain;
	margin-right: 10px;
  background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU1IDU1IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1NSA1NTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIGQ9Ik01NSwyNy41QzU1LDEyLjMzNyw0Mi42NjMsMCwyNy41LDBTMCwxMi4zMzcsMCwyNy41YzAsOC4wMDksMy40NDQsMTUuMjI4LDguOTI2LDIwLjI1OGwtMC4wMjYsMC4wMjNsMC44OTIsMC43NTIgIGMwLjA1OCwwLjA0OSwwLjEyMSwwLjA4OSwwLjE3OSwwLjEzN2MwLjQ3NCwwLjM5MywwLjk2NSwwLjc2NiwxLjQ2NSwxLjEyN2MwLjE2MiwwLjExNywwLjMyNCwwLjIzNCwwLjQ4OSwwLjM0OCAgYzAuNTM0LDAuMzY4LDEuMDgyLDAuNzE3LDEuNjQyLDEuMDQ4YzAuMTIyLDAuMDcyLDAuMjQ1LDAuMTQyLDAuMzY4LDAuMjEyYzAuNjEzLDAuMzQ5LDEuMjM5LDAuNjc4LDEuODgsMC45OCAgYzAuMDQ3LDAuMDIyLDAuMDk1LDAuMDQyLDAuMTQyLDAuMDY0YzIuMDg5LDAuOTcxLDQuMzE5LDEuNjg0LDYuNjUxLDIuMTA1YzAuMDYxLDAuMDExLDAuMTIyLDAuMDIyLDAuMTg0LDAuMDMzICBjMC43MjQsMC4xMjUsMS40NTYsMC4yMjUsMi4xOTcsMC4yOTJjMC4wOSwwLjAwOCwwLjE4LDAuMDEzLDAuMjcxLDAuMDIxQzI1Ljk5OCw1NC45NjEsMjYuNzQ0LDU1LDI3LjUsNTUgIGMwLjc0OSwwLDEuNDg4LTAuMDM5LDIuMjIyLTAuMDk4YzAuMDkzLTAuMDA4LDAuMTg2LTAuMDEzLDAuMjc5LTAuMDIxYzAuNzM1LTAuMDY3LDEuNDYxLTAuMTY0LDIuMTc4LTAuMjg3ICBjMC4wNjItMC4wMTEsMC4xMjUtMC4wMjIsMC4xODctMC4wMzRjMi4yOTctMC40MTIsNC40OTUtMS4xMDksNi41NTctMi4wNTVjMC4wNzYtMC4wMzUsMC4xNTMtMC4wNjgsMC4yMjktMC4xMDQgIGMwLjYxNy0wLjI5LDEuMjItMC42MDMsMS44MTEtMC45MzZjMC4xNDctMC4wODMsMC4yOTMtMC4xNjcsMC40MzktMC4yNTNjMC41MzgtMC4zMTcsMS4wNjctMC42NDgsMS41ODEtMSAgYzAuMTg1LTAuMTI2LDAuMzY2LTAuMjU5LDAuNTQ5LTAuMzkxYzAuNDM5LTAuMzE2LDAuODctMC42NDIsMS4yODktMC45ODNjMC4wOTMtMC4wNzUsMC4xOTMtMC4xNCwwLjI4NC0wLjIxN2wwLjkxNS0wLjc2NCAgbC0wLjAyNy0wLjAyM0M1MS41MjMsNDIuODAyLDU1LDM1LjU1LDU1LDI3LjV6IE0yLDI3LjVDMiwxMy40MzksMTMuNDM5LDIsMjcuNSwyUzUzLDEzLjQzOSw1MywyNy41ICBjMCw3LjU3Ny0zLjMyNSwxNC4zODktOC41ODksMTkuMDYzYy0wLjI5NC0wLjIwMy0wLjU5LTAuMzg1LTAuODkzLTAuNTM3bC04LjQ2Ny00LjIzM2MtMC43Ni0wLjM4LTEuMjMyLTEuMTQ0LTEuMjMyLTEuOTkzdi0yLjk1NyAgYzAuMTk2LTAuMjQyLDAuNDAzLTAuNTE2LDAuNjE3LTAuODE3YzEuMDk2LTEuNTQ4LDEuOTc1LTMuMjcsMi42MTYtNS4xMjNjMS4yNjctMC42MDIsMi4wODUtMS44NjQsMi4wODUtMy4yODl2LTMuNTQ1ICBjMC0wLjg2Ny0wLjMxOC0xLjcwOC0wLjg4Ny0yLjM2OXYtNC42NjdjMC4wNTItMC41MTksMC4yMzYtMy40NDgtMS44ODMtNS44NjRDMzQuNTI0LDkuMDY1LDMxLjU0MSw4LDI3LjUsOCAgcy03LjAyNCwxLjA2NS04Ljg2NywzLjE2OGMtMi4xMTksMi40MTYtMS45MzUsNS4zNDUtMS44ODMsNS44NjR2NC42NjdjLTAuNTY4LDAuNjYxLTAuODg3LDEuNTAyLTAuODg3LDIuMzY5djMuNTQ1ICBjMCwxLjEwMSwwLjQ5NCwyLjEyOCwxLjM0LDIuODIxYzAuODEsMy4xNzMsMi40NzcsNS41NzUsMy4wOTMsNi4zODl2Mi44OTRjMCwwLjgxNi0wLjQ0NSwxLjU2Ni0xLjE2MiwxLjk1OGwtNy45MDcsNC4zMTMgIGMtMC4yNTIsMC4xMzctMC41MDIsMC4yOTctMC43NTIsMC40NzZDNS4yNzYsNDEuNzkyLDIsMzUuMDIyLDIsMjcuNXogTTQyLjQ1OSw0OC4xMzJjLTAuMzUsMC4yNTQtMC43MDYsMC41LTEuMDY3LDAuNzM1ICBjLTAuMTY2LDAuMTA4LTAuMzMxLDAuMjE2LTAuNSwwLjMyMWMtMC40NzIsMC4yOTItMC45NTIsMC41Ny0xLjQ0MiwwLjgzYy0wLjEwOCwwLjA1Ny0wLjIxNywwLjExMS0wLjMyNiwwLjE2NyAgYy0xLjEyNiwwLjU3Ny0yLjI5MSwxLjA3My0zLjQ4OCwxLjQ3NmMtMC4wNDIsMC4wMTQtMC4wODQsMC4wMjktMC4xMjcsMC4wNDNjLTAuNjI3LDAuMjA4LTEuMjYyLDAuMzkzLTEuOTA0LDAuNTUyICBjLTAuMDAyLDAtMC4wMDQsMC4wMDEtMC4wMDYsMC4wMDFjLTAuNjQ4LDAuMTYtMS4zMDQsMC4yOTMtMS45NjQsMC40MDJjLTAuMDE4LDAuMDAzLTAuMDM2LDAuMDA3LTAuMDU0LDAuMDEgIGMtMC42MjEsMC4xMDEtMS4yNDcsMC4xNzQtMS44NzUsMC4yMjljLTAuMTExLDAuMDEtMC4yMjIsMC4wMTctMC4zMzQsMC4wMjVDMjguNzUxLDUyLjk3LDI4LjEyNyw1MywyNy41LDUzICBjLTAuNjM0LDAtMS4yNjYtMC4wMzEtMS44OTUtMC4wNzhjLTAuMTA5LTAuMDA4LTAuMjE4LTAuMDE1LTAuMzI2LTAuMDI1Yy0wLjYzNC0wLjA1Ni0xLjI2NS0wLjEzMS0xLjg5LTAuMjMzICBjLTAuMDI4LTAuMDA1LTAuMDU2LTAuMDEtMC4wODQtMC4wMTVjLTEuMzIyLTAuMjIxLTIuNjIzLTAuNTQ2LTMuODktMC45NzFjLTAuMDM5LTAuMDEzLTAuMDc5LTAuMDI3LTAuMTE4LTAuMDQgIGMtMC42MjktMC4yMTQtMS4yNTEtMC40NTEtMS44NjItMC43MTNjLTAuMDA0LTAuMDAyLTAuMDA5LTAuMDA0LTAuMDEzLTAuMDA2Yy0wLjU3OC0wLjI0OS0xLjE0NS0wLjUyNS0xLjcwNS0wLjgxNiAgYy0wLjA3My0wLjAzOC0wLjE0Ny0wLjA3NC0wLjIxOS0wLjExM2MtMC41MTEtMC4yNzMtMS4wMTEtMC41NjgtMS41MDQtMC44NzZjLTAuMTQ2LTAuMDkyLTAuMjkxLTAuMTg1LTAuNDM1LTAuMjc5ICBjLTAuNDU0LTAuMjk3LTAuOTAyLTAuNjA2LTEuMzM4LTAuOTMzYy0wLjA0NS0wLjAzNC0wLjA4OC0wLjA3LTAuMTMzLTAuMTA0YzAuMDMyLTAuMDE4LDAuMDY0LTAuMDM2LDAuMDk2LTAuMDU0bDcuOTA3LTQuMzEzICBjMS4zNi0wLjc0MiwyLjIwNS0yLjE2NSwyLjIwNS0zLjcxNGwtMC4wMDEtMy42MDJsLTAuMjMtMC4yNzhjLTAuMDIyLTAuMDI1LTIuMTg0LTIuNjU1LTMuMDAxLTYuMjE2bC0wLjA5MS0wLjM5NmwtMC4zNDEtMC4yMjEgIGMtMC40ODEtMC4zMTEtMC43NjktMC44MzEtMC43NjktMS4zOTJ2LTMuNTQ1YzAtMC40NjUsMC4xOTctMC44OTgsMC41NTctMS4yMjNsMC4zMy0wLjI5OHYtNS41N2wtMC4wMDktMC4xMzEgIGMtMC4wMDMtMC4wMjQtMC4yOTgtMi40MjksMS4zOTYtNC4zNkMyMS41ODMsMTAuODM3LDI0LjA2MSwxMCwyNy41LDEwYzMuNDI2LDAsNS44OTYsMC44Myw3LjM0NiwyLjQ2NiAgYzEuNjkyLDEuOTExLDEuNDE1LDQuMzYxLDEuNDEzLDQuMzgxbC0wLjAwOSw1LjcwMWwwLjMzLDAuMjk4YzAuMzU5LDAuMzI0LDAuNTU3LDAuNzU4LDAuNTU3LDEuMjIzdjMuNTQ1ICBjMCwwLjcxMy0wLjQ4NSwxLjM2LTEuMTgxLDEuNTc1bC0wLjQ5NywwLjE1M2wtMC4xNiwwLjQ5NWMtMC41OSwxLjgzMy0xLjQzLDMuNTI2LTIuNDk2LDUuMDMyYy0wLjI2MiwwLjM3LTAuNTE3LDAuNjk4LTAuNzM2LDAuOTQ5ICBsLTAuMjQ4LDAuMjgzVjM5LjhjMCwxLjYxMiwwLjg5NiwzLjA2MiwyLjMzOCwzLjc4Mmw4LjQ2Nyw0LjIzM2MwLjA1NCwwLjAyNywwLjEwNywwLjA1NSwwLjE2LDAuMDgzICBDNDIuNjc3LDQ3Ljk3OSw0Mi41NjcsNDguMDU0LDQyLjQ1OSw0OC4xMzJ6IiBmaWxsPSIjODc4Nzg3Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=")
}

.bentral-search-results .bentral-floor {
	width: 23px;
	height: 23px;
	float: right;
    background-size: contain;
	margin-right: 10px;
  background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDIyNy42MzYgMjI3LjYzNiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjI3LjYzNiAyMjcuNjM2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggZD0iTTIyMy4wNjEsMEg0LjU3NUMyLjA0OSwwLDAuMDAxLDIuMDQ4LDAuMDAxLDQuNTc0djIxOC40ODhjMCwyLjUyNiwyLjA0OCw0LjU3NCw0LjU3NCw0LjU3NEgxMzcuODMgIGMyLjUyNiwwLDQuNTczLTIuMDQ4LDQuNTczLTQuNTc0YzAtMi41MjYtMi4wNDctNC41NzQtNC41NzMtNC41NzRIOS4xNDlWMTExLjg4MWg2My43OTh2NDMuODQ5YzAsMi41MjYsMi4wNDgsNC41NzQsNC41NzQsNC41NzQgIGMyLjUyNiwwLDQuNTc0LTIuMDQ4LDQuNTc0LTQuNTc0VjU5Ljk2YzAtMi41MjYtMi4wNDgtNC41NzQtNC41NzQtNC41NzRjLTIuNTI2LDAtNC41NzQsMi4wNDgtNC41NzQsNC41NzR2NDIuNzczSDkuMTQ5VjkuMTQ4ICBoMTI0LjEwOHY1Ny4yNzFjMCwyLjUyNiwyLjA0Nyw0LjU3NCw0LjU3Myw0LjU3NGg0OC4zNzJjMi41MjYsMCw0LjU3My0yLjA0OCw0LjU3My00LjU3NGMwLTIuNTI2LTIuMDQ3LTQuNTc0LTQuNTczLTQuNTc0aC00My43OTkgIFY5LjE0OGg3Ni4wODV2MTQyLjAwOUgxMzcuODNjLTIuNTI2LDAtNC41NzMsMi4wNDgtNC41NzMsNC41NzRjMCwyLjUyNiwyLjA0Nyw0LjU3NCw0LjU3Myw0LjU3NGg4MC42NTh2NTguMTg1aC0zMi4yODYgIGMtMi41MjYsMC00LjU3MywyLjA0OC00LjU3Myw0LjU3NGMwLDIuNTI2LDIuMDQ3LDQuNTc0LDQuNTczLDQuNTc0aDM2Ljg1OWMyLjUyNiwwLDQuNTczLTIuMDQ4LDQuNTczLTQuNTc0VjQuNTc0ICBDMjI3LjYzNSwyLjA0OCwyMjUuNTg4LDAsMjIzLjA2MSwweiIgZmlsbD0iIzg3ODc4NyIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K")
}'
                    ];
                default:
                    return [
                        'template' => wp_unslash(get_option('bentral_search_result_template')), 'style' => wp_unslash(get_option('bentral_result_style'))
                    ];
            }
        }

        public static function defaultPagePostmeta()
        {
            return '{
    "mfn-post-hide-title": "1",
    "mfn-post-hide-image": "1"
}';
        }

        public static function defaultSearchStyle()
        {
            return '/* -------------- SEARCH STYLE -------------- */
.bentral-book-form {
    background-color: rgb(255 255 255 / 90%)!important;
    border-radius: 5px;
  	box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
}

.bentral-book-form .bentral_search_form {
  display: inline-block;
  width:100%;
}

.bentral-book-form .bentral-btn,
.bentral-book-form .bentral-input,
.bentral-book-form .bentral-select{
  width: 100%!important;
}';
        }

        public static function defaultGalleryStyle()
        {
            return '/* -------------- GALLERY STYLE -------------- */
.card-zoom-image {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}
.card-zoom-image:hover {
    transform: scale(1.05);
}';
        }

        public static function defaultPageTemplate()
        {
            return '<div class="bentral-shortcode">
	{{ property_name }}
	<div class="row">
		<div class="col-md-8">
			{{ property_address }}
			<br/>
			{{ property_postcode }} {{ property_city }}
			<br/>
			{{ property_country }}
			<hr>
			[bentral_gallery id="{{ property_page_id }}"]
			[bentral_price id="{{ property_page_id }}"]
			[bentral_calendar id="{{ property_page_id }}"]
		</div>
		<div class="col-md-4">
			[bentral_reservation id="{{ property_page_id }}"]
		</div>
	</div>
</div>';
        }

        public static function defaultGalleryTemplate()
        {
            return '<div class="bentral-img overflow-hidden w-full rounded cursor-pointer" data-full-img="{{ property_image_url }}">
	<div class="bentral-bg card-zoom-image sm:h-24 md:h-32 h-40 w-full bg-cover bg-center rounded-sm" style="background-image: url({{ property_image_url_thumb }});"></div>
</div>';
        }

        public static function defaultResultsRootTemplate()
        {
            return '<div class="container mx-auto">
    <div class="bentral-search-results flex flex-wrap -mx-4" data-block="bentral-search-results"></div>
</div>';
        }

        public static function defaultResultsTemplate()
        {
            return '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
	<div class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
		<a href="{{ link }}">
      		<div class="relative pb-48 overflow-hidden">
				<img class="absolute inset-0 h-full w-full object-cover bentral-image" src="{{ image_url }}" alt="{{ title }}">
			</div>
		</a>
		<div class="p-4" style="height:70px;">
			<a href="{{ link }}">
				<h2 class="card-title font-bold text-center bentral-title">{{ title }}</h2>
			</a>
	  	</div>
	  	<div class="p-4" style="height:70px;">
			<a href="{{ property_title }}">
				<h2 class="card-title font-bold text-center bentral-property-title">{{ property_title }}</h2>
			</a>
	  	</div>
      	<div class="p-4 pt-0 items-center text-sm text-gray-600">
			<div class="items-center text-center bentral-price">
				<span class="text-sm font-semibold"></span> <span class="font-bold text-xl">{{ price }}</span>
          		<span class="text-sm font-semibold">{{ currency }}</span>
			</div>			
		</div>
        <div class="p-4 pt-1 pb-1 border-t border-b text-xs text-gray-700">		
			<span class="flex items-center mb-1 bentral-capacity-basic">
				<i class="fas fa-bed fa-fw text-gray-700 mr-2"></i>{{ capacity_basic_title }}: {{ capacity_basic_value }}
			</span>
			<span class="flex items-center bentral-capacity-additional">
				<i class="fas fa-bed fa-fw text-gray-700 mr-2"></i>{{ capacity_additional_title }}: {{ capacity_additional_value }}
			</span>        
		</div>
        <div class="p-4 flex items-center text-sm text-gray-600">        	
		    <a class="bentral-book bg-gray-600 hover:bg-gray-700 w-full text-center pt-2 pb-2 text-white hover:text-white font-bold uppercase" href="{{ link }}">{{ book_title }}</a>
		</div>
	</div>
</div>';
        }

        public static function defaultResultsStyle()
        {
            return '/* -------------- RESULTS STYLE -------------- */
.bentral-search-results .btn-book {
    background: #c32827!important;
}

.bentral-search-results .capacity{
	font-size: 0.9em;
}';
        }

        public static function defaultServiceStyle()
        {
            return '/* -------------- SERVICE STYLE -------------- */
.bentral-services .item {
    width: 44%;
    float: left;
    font-size: 13px;
    margin-bottom: 3px;
    padding: 16px 20px;
    margin-right: 3px;
    color: #888888;
    background-color: #f5f5f5;
}
';
        }

        public static function defaultCardTemplate()
        {
            return '<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
	<div class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
		<a href="{{ link }}">
      		<div class="relative pb-48 overflow-hidden">
				<img class="absolute inset-0 h-full w-full object-cover bentral-image" src="{{ image_url }}" alt="{{ title }}">
			</div>
		</a>
		<div class="p-4" style="height:70px;">
			<a href="{{ link }}">
				<h2 class="card-title font-bold text-center bentral-title">{{ title }}</h2>
			</a>
	  	</div>
	  	<div class="p-4" style="height:70px;">
			<a href="{{ property_title }}">
				<h2 class="card-title font-bold text-center bentral-property-title">{{ property_title }}</h2>
			</a>
	  	</div>
      	<div class="p-4 pt-0 items-center text-sm text-gray-600">
			<div class="items-center text-center bentral-price">
				<span class="text-sm font-semibold"></span> <span class="font-bold text-xl">{{ price }}</span>
          		<span class="text-sm font-semibold">{{ currency }}</span>
			</div>			
		</div>
        <div class="p-4 pt-1 pb-1 border-t border-b text-xs text-gray-700">		
			<span class="flex items-center mb-1 bentral-capacity-basic">
				<i class="fas fa-bed fa-fw text-gray-700 mr-2"></i>{{ capacity_basic_title }}: {{ capacity_basic_value }}
			</span>
			<span class="flex items-center bentral-capacity-additional">
				<i class="fas fa-bed fa-fw text-gray-700 mr-2"></i>{{ capacity_additional_title }}: {{ capacity_additional_value }}
			</span>        
		</div>
        <div class="p-4 flex items-center text-sm text-gray-600">        	
		    <a class="bentral-book bg-gray-600 hover:bg-gray-700 w-full text-center pt-2 pb-2 text-white hover:text-white font-bold uppercase" href="{{ link }}">{{ book_title }}</a>
		</div>
	</div>
</div>';
        }

        public static function defaultServiceTemplate()
        {
            return 'aaaa';
        }

        public static function defaultCardStyle()
        {
            return '/* -------------- CARD STYLE -------------- */
.bentral-search-results .btn-book {
    background: #c32827!important;
}
.bentral-search-results .capacity{
	font-size: 0.9em;
}';
        }

        public static function defaultEmptySearchResult()
        {
            return '<div class="bentra-empty-search-result">
	<h3>
		{{ message }}
	</h3>
</div>';
        }

        public static function defaultErrorSearchResult()
        {
            return '<div class="bentra-error-search-result">
	<h3>
		{{ message }}
	</h3>
</div>';
        }

        public static function defaulLanguageData()
        {
            return
                '{
	"sl": {
		"name": "Slovensko",		
		"check_in": "Datum prihoda",
		"check_out": "Datum odhoda",
		"guests": "Število gostov",
		"search": "Poišči",
		"search_title": "&nbsp;&nbsp;",
		"results_empty": "V iskanem terminu ni zadetkov.",
		"results_error": "Napaka pri iskanju",
		"capacity_basic": "Ležišča",
		"capacity_additional": "Dodatno",
		"book": "Rezerviraj",
		"date_format": {
			"dropdown": "d.m.Y",
			"modal": "DD.MM.YYYY",
			"input_delimiter": ".",
			"input_mask": [
				"d",
				"m",
				"Y"
			]
		},		
		"services": {
			"internet": "Internet",
			"ac": "Klimatska naprava",
			"infantBed": "Otroška posteljica",
			"extraBed": "Dodatno pomožno ležišče",
			"taxAdult": "Turistična taksa (odrasli)",
			"taxChild": "Turistična taksa (otroci)",
			"reservation": "Rezervacija",
			"registration": "Prijavnina",
			"deposit": "Deposit",
			"finalCleaning": "Zaključno čiščenje",
			"pet": "Hišni ljubljenčki",
			"breakfast": "Zajtrk",
			"halfboard": "Polpenzion",
			"fullboard": "Polni penzion"
		},
		"days": {
			"day1": "Po",
			"day2": "To",
			"day3": "Sr",
			"day4": "Če",
			"day5": "Pe",
			"day6": "So",
			"day7": "Ne"
		},
		"month": {
            "mon1": "Jan",
            "mon2": "Feb",
            "mon3": "Mar",
            "mon4": "Apr",
            "mon5": "Maj",
            "mon6": "Jun",
            "mon7": "Jul",
            "mon8": "Avg",
            "mon9": "Sep",
            "mon10": "Okt",
            "mon11": "Nov",
            "mon12": "Dec"
        }
	},
	"en": {
		"name": "English",
		"check_in": "Arrival",
		"check_out": "Departure",
		"guests": "Number of guests",
		"search": "Search",
		"search_title": "&nbsp;&nbsp;",
		"results_empty": "There are no results in the search term.",
		"results_error": "Search error",
		"capacity_basic": "Beds",
		"capacity_additional": "Additionally",
		"book": "Book",
		"date_format": {
			"dropdown": "Y-m-d",
			"modal": "YYYY-MM-DD",
			"input_delimiter": ".",
			"input_mask": [
				"Y",
				"m",
				"d"
			]
		},		
		"days": {
			"day1": "Mo",
			"day2": "Tu",
			"day3": "We",
			"day4": "Th",
			"day5": "Fr",
			"day6": "Sa",
			"day7": "Su"
		},
		"services": {
			"internet": "Internet",
			"ac": "Air conditioning",
			"infantBed": "Baby cot",
			"extraBed": "Extra extra bed",
			"taxAdult": "Tourist tax (adults)",
			"taxChild": "Tourist tax (children)",
			"reservation": "Reservation",
			"registration": "Registration fee",
			"deposit": "Deposit",
			"finalCleaning": "finalCleaning",
			"pet": "Pets",
			"breakfast": "Breakfast",
			"halfboard": "Half board",
			"fullboard": "Full board"
		},
		"month": {
            "mon1": "Jan",
            "mon2": "Feb",
            "mon3": "Mar",
            "mon4": "Apr",
            "mon5": "May",
            "mon6": "Jun",
            "mon7": "Jul",
            "mon8": "Aug",
            "mon9": "Sep",
            "mon10": "Oct",
            "mon11": "Nov",
            "mon12": "Dec"
        }
	},
	"de": {
		"name": "German",		
		"check_in": "Ankunft ",
		"check_out": "Abfahrt",
		"guests": "Anzahl der Gäste",
		"search": "Finde es",
		"search_title": "&nbsp;&nbsp;",
		"results_empty": "Der Suchbegriff enthält keine Ergebnisse.",
		"results_error": "Suche Fehler",
		"capacity_basic": "Betten",
		"capacity_additional": "Zustellbetten",
		"book": "Buchen",
		"date_format": {
			"dropdown": "d.m.Y",
			"modal": "DD.MM.YYYY",
			"input_delimiter": ".",
			"input_mask": [
				"d",
				"m",
				"Y"
			]
		},
		"services": {
			"internet": "Internet",
			"ac": "Klimaanlage",
			"infantBed": "Crib",
			"extraBed": "extra extra bed",
			"taxAdult": "Kurtaxe (Erwachsene)",
			"taxChild": "Kurtaxe (Kinder)",
			"reservation": "Reservierung",
			"registration": "Anmeldegebühr",
			"deposit": "Einzahlung",
			"finalCleaning": "finalCleaning",
			"pet": "Haustiere",
			"breakfast": "Frühstück",
			"halfboard": "Halbpension",
			"fullboard": "Vollpension"
		},		
		"days": {
            "day1": "Mo",
            "day2": "Di",
            "day3": "Wir",
            "day4": "Do",
            "day5": "Fr",
            "day6": "Sa",
            "day7": "So"
		},
		"month": {
            "mon1": "Jan",
            "mon2": "Feb",
            "mon3": "Mar",
            "mon4": "Apr",
            "mon5": "Maj",
            "mon6": "Jun",
            "mon7": "Jul",
            "mon8": "Avg",
            "mon9": "Sep",
            "mon10": "Okt",
            "mon11": "Nov",
            "mon12": "Dec"
        }
	},
	"it": {
		"name": "Italian",		
		"check_in": "Data reddito",
		"check_out": "Data di partenza",
		"guests": "Numero di ospiti",
		"search": "Verifica disponibilità",
		"search_title": "&nbsp;&nbsp;",
		"results_empty": "Nessun risultato nel termine di ricerca.",
		"results_error": "Errore di ricerca",
		"capacity_basic": "Letti",
		"capacity_additional": "Letti aggiuntivi",
		"book": "Prenota ora",
		"date_format": {
			"dropdown": "d.m.Y",
			"modal": "DD.MM.YYYY",
			"input_delimiter": ".",
			"input_mask": [
				"d",
				"m",
				"Y"
			]
		},
		"services": {
			"internet": "Internet",
			"ac": "Aria condizionata",
			"infantBed": "Crib",
			"extraBed": "Letto extra extra",
			"taxAdult": "Tassa di soggiorno (adulti)",
			"taxChild": "Tassa di soggiorno (bambini)",
			"reservation": "Reservation",
			"registration": "quota di registrazione",
			"deposit": "Deposit",
			"finalCleaning": "finalCleaning",
			"five": "Animali domestici",
			"breakfast": "Breakfast",
			"halfboard": "Half board",
			"pensione completa": "Pensione completa"
		},		
		"days": {
            "day1": "Lu",
            "day2": "Tu",
            "day3": "Noi",
            "day4": "Gio",
            "day5": "ven",
            "day6": "Sa",
            "day7": "Dom"
		},
		"month": {
            "mon1": "Jan",
            "mon2": "Feb",
            "mon3": "Mar",
            "mon4": "Apr",
            "mon5": "May",
            "mon6": "Jun",
            "mon7": "Jul",
            "mon8": "Aug",
            "mon9": "Set",
            "mon10": "Ott",
            "mon11": "Nuovo",
            "mon12": "Dic"
        }
	},
	"ru": {
		"name": "Russian",		
		"check_in": "Дата получения дохода",
		"check_out": "Дата отъезда",
		"guests": "Количество гостей",
		"search": "Проверить наличие",
		"search_title": "&nbsp;&nbsp;",
		"results_empty": "По запросу нет результатов.",
		"results_error": "Ошибка поиска",
		"capacity_basic": "Кровати",
		"capacity_additional": "Дополнительно",
		"book": "Книга",
		"date_format": {
			"dropdown": "d.m.Y",
			"modal": "DD.MM.YYYY",
			"input_delimiter": ".",
			"input_mask": [
				"d",
				"m",
				"Y"
			]
		},
		"services": {
			"internet": "Интернет",
			"ac": "Кондиционер",
			"infantBed": "Детская кроватка",
			"extraBed": "Дополнительная кровать",
			"taxAdult": "Туристический налог (взрослые)",
			"taxChild": "Туристический сбор (дети)",
			"reservation": "Бронирование",
			"registration": "Регистрационный взнос",
			"deposit": "Депозит",
			"finalCleaning": "Заключительная уборка",
			"pet": "Домашние животные",
			"breakfast": "Завтрак",
			"halfboard": "Полупансион",
			"fullboard": "Полный пансион"
		},		
		"days": {
			"day1": "Пн",
            "day2": "Вт",
            "day3": "Мы",
            "day4": "Чт",
            "day5": "Пт",
            "day6": "Sa",
            "day7": "Вс"
		},
		"month": {
            "mon1": "Январь",
            "mon2": "Февраль",
            "mon3": "марш",
            "mon4": "апреля",
            "mon5": "Май",
            "mon6": "июнь",
            "mon7": "июль",
            "mon8": "август",
            "mon9": "сентябрь",
            "mon10": "Октябрь",
            "mon11": "Ноябрь",
            "mon12": "Декабрь"
        }
	},
	"hr": {
		"name": "Hrvatska",		
		"check_in": "Datum dolaska",
		"check_out": "Datum polaska",
		"guests": "Broj gostiju",
		"search": "Pronađi",
		"search_title": "  ",
		"results_empty": "U pojmu za pretraživanje nema rezultata.",
		"results_error": "Pogreška pretraživanja",
		"capacity_basic": "Kreveti",
		"capacity_additional": "Dodatni kreveti",
		"book": "Rezervirati",
		"date_format": {
			"dropdown": "d.m.Y",
			"modal": "DD.MM.YYYY",
			"input_delimiter": ".",
			"input_mask": [
				"d",
				"m",
				"Y"
			]
		},
		"services": {
			"Internet": "Internet",
			"ac": "Klima uređaj",
			"infantBed": "Jaslice",
			"extraBed": "Dodatni pomoćni ležaj",
			"taxAdult": "Turistička taksa (odrasli)",
			"taxChild": "Turistička taksa (djeca)",
			"rezervacija": "Rezervacija",
			"registration": "Kotizacija",
			"deposit": "Depozit",
			"finalCleaning": "FinalCleaning",
			"pet": "Kućni ljubimci",
			"breakfast": "Doručak",
			"half board": "Polupansion",
			"full board": "Puni pansion"
		},		
		"days": {
            "day1": "Mo",
            "day2": "Tu",
            "day3": "Mi",
            "day4": "Th",
            "day5": "Pet",
            "day6": "Sa",
            "day7": "Ned"
         },
         "month": {
            "mon1": "Jan",
            "mon2": "Vel",
            "mon3": "Ožu",
            "mon4": "Tra",
            "mon5": "Svi",
            "mon6": "Lip",
            "mon7": "Srp",
            "mon8": "Kol",
            "mon9": "Ruj",
            "mon10": "Lis",
            "mon11": "Nov",
            "mon12": "Pro"
        }
	}, 
	"hu": {
		"name": "Hungarian",
		"check_in": "Jövedelem dátuma",
		"check_out": "Indulás dátuma",
		"guests": "Vendégek száma",
		"search": "Keresés",
		"search_title": "",
		"results_empty": "Nincs találat a keresési kifejezésben.",
		"results_error": "Keresési hiba",
		"capacity_basic": "Ágyak",
		"capacity_additional": "További",
		"book": "Könyv",
		"date_format": {
			"dropdown": "d.m.Y",
			"modal": "DD.MM.YYYY",
			"input_delimiter": "."
		},
		"month": {
			"mon1": "Jan",
			"mon2": "Feb",
			"mon3": "Már",
			"mon4": "Ápr",
			"mon5": "Máj",
			"mon6": "Jún",
			"mon7": "Júl",
			"mon8": "Avg",
			"mon9": "Sep",
			"mon10": "Oct",
			"mon11": "Új",
			"mon12": "Dec"
		},
		"days": {
			"day1": "After",
			"day2": "Igen",
			"day3": "Sr",
			"day4": "Ha",
			"day5": "Pe",
			"day6": "Szóval",
			"day7": "Nem"
		},
		"services": {
			"internet": "Internet",
			"ac": "Légkondicionálás",
			"infantBed": "Crib",
			"extraBed": "Extra pótágy",
			"taxAdult": "Turista adó (felnőtteknek)",
			"taxChild": "Turista adó (gyermekek)",
			"reservation": "Foglalás",
			"registration": "Regisztrációs díj",
			"deposit": "Deposit",
			"finalCleaning": "Végső takarítás",
			"pet": "Kisállatok",
			"breakfast": "Reggeli",
			"halfboard": "Félpanzió",
			"fullboard": "Teljes tábla"
		}
	}
}';
        }
    }
}