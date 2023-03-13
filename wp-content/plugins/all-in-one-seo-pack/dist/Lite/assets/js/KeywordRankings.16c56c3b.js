import{a as c,m as g,c as y}from"./vuex.esm.8fdeb4b6.js";import{C as D}from"./Blur.f36c594d.js";import{C as S}from"./Card.fbb39c92.js";import{G as R,a as B}from"./Row.830f6397.js";import{G as K,S as m,T as I,a as F}from"./Table.6c571c33.js";import{n as l}from"./_plugin-vue2_normalizer.61652a7c.js";import{K as A}from"./KeywordsGraph.5c963925.js";import{d as f}from"./helpers.de7566d0.js";import{W as U,L}from"./WpTable.662e923c.js";import"./default-i18n.3a91e0e5.js";import"./constants.59a77347.js";import"./index.83e63cda.js";import"./SaveChanges.e40a9083.js";import{P as w}from"./PostTypes.9ab32454.js";import{C as O}from"./Tooltip.68a8a92b.js";import{C as k}from"./Table.8c51f443.js";import{C as v}from"./Index.3dda5f16.js";import{C as H,e as E}from"./Caret.6d7f2e24.js";import{R as G}from"./RequiredPlans.ff624e20.js";import"./index.b661d021.js";import"./client.e62d6c37.js";import"./_commonjsHelpers.f84db168.js";import"./translations.c394afe3.js";import"./portal-vue.esm.98f2e05b.js";import"./Slide.15a07930.js";import"./attachments.8701e3a4.js";import"./cleanForSlug.961c836c.js";import"./isArrayLikeObject.cf278c5f.js";import"./html.f941cb8b.js";import"./Index.3ba1c059.js";const M={components:{Graph:K},computed:{...c("search-statistics",["data","loading"]),series(){var t,s;if(!((s=(t=this.data)==null?void 0:t.keywords)!=null&&s.distribution))return[];const r=this.data.keywords.distribution;return[{name:this.$t.__("Keywords",this.$td),data:[{x:this.$t.__("Top 3 Position",this.$td),y:r.top3,fillColor:"#005AE0"},{x:this.$t.__("4-10 Position",this.$td),y:r.top10,fillColor:"#00AA63"},{x:this.$t.__("11-50 Position",this.$td),y:r.top50,fillColor:"#F18200"},{x:this.$t.__("50-100 Position",this.$td),y:r.top100,fillColor:"#DF2A4A"}]}]}}};var j=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-search-statistics-keywords-distribution-graph"},[s("graph",{attrs:{series:t.series,loading:t.loading.keywords,preset:"keywordsDistribution"}})],1)},q=[],N=l(M,j,q,!1,null,null,null,null);const W=N.exports;const z={components:{CoreLoader:H,CoreWpTable:k,Statistic:m},mixins:[w],props:{index:{type:Number,required:!0},postDetail:{type:Boolean,required:!1,default:!1}},data(){return{loading:!1}},computed:{...c("search-statistics",["data"]),postColumns(){return[{slug:"post_title",label:this.$t.__("Title",this.$td),width:"100%"},{slug:"clicks",label:this.$t.__("Clicks",this.$tdPro),width:"120px"},{slug:"ctr",label:this.$t.__("Avg. CTR",this.$tdPro),width:"120px"},{slug:"impressions",label:this.$t.__("Impressions",this.$tdPro),width:"120px"},{slug:"position",label:this.$t.__("Position",this.$tdPro),width:"120px"}]},keywords(){return this.postDetail?this.data.postDetail.keywords.paginated.rows:this.data.keywords.paginated.rows},row(){return this.keywords[this.index]}},methods:{...g("search-statistics",["getPagesByKeywords"]),openPostDetail(r){this.$router.push({path:"/post-detail",query:{postId:r.postId,previousRoute:this.$route.name}})}},mounted(){var r,t;!this.row||(t=(r=this.row)==null?void 0:r.pages)!=null&&t.length||(this.loading=!0,this.getPagesByKeywords([this.row.keyword]).then(s=>{this.loading=!1;const e=s[this.row.keyword];e&&(this.postDetail?this.data.postDetail.keywords.paginated.rows[this.index].pages=Object.values(e).slice(0,10):this.data.keywords.paginated.rows[this.index].pages=Object.values(e).slice(0,10))}))}};var J=function(){var t=this,s=t._self._c;return s("div",{staticClass:"keyword-inner"},[t.loading?s("div",{staticClass:"keyword-inner-loading"},[s("core-loader",{attrs:{dark:""}})],1):t._e(),t.row.pages&&!t.loading?s("core-wp-table",{key:1,ref:"table",staticClass:"posts-table",attrs:{columns:t.postColumns,rows:t.row.pages,"show-header":!1,"show-bulk-actions":!1,"show-table-footer":!1},scopedSlots:t._u([{key:"post_title",fn:function({row:e}){return[s("div",{staticClass:"post-title"},[e.postId?s("a",{attrs:{href:"#"},on:{click:function(i){return t.openPostDetail(e)}}},[t._v(" "+t._s(e.postTitle)+" ")]):s("span",{staticClass:"post-title"},[t._v(" "+t._s(e.postTitle)+" ")])]),e.postId?s("div",{staticClass:"row-actions"},[s("span",[s("a",{staticClass:"view",attrs:{href:e.context.permalink,target:"_blank"}},[s("span",[t._v(t._s(t.viewPost(e.context.postType.singular)))])]),t._v(" | ")]),s("span",[s("a",{staticClass:"edit",attrs:{href:e.context.editLink,target:"_blank"}},[s("span",[t._v(t._s(t.editPost(e.context.postType.singular)))])])])]):t._e()]}},{key:"clicks",fn:function({row:e}){return[t._v(" "+t._s(t.$numbers.compactNumber(e.clicks))+" ")]}},{key:"ctr",fn:function({row:e}){return[t._v(" "+t._s(e.ctr)+"% ")]}},{key:"impressions",fn:function({row:e}){return[t._v(" "+t._s(t.$numbers.compactNumber(e.impressions))+" ")]}},{key:"position",fn:function({row:e}){return[s("statistic",{attrs:{type:"position",total:e.position,difference:e.difference.position}})]}}],null,!1,3675777330)}):t._e()],1)},Q=[],V=l(z,J,Q,!1,null,null,null,null);const X=V.exports;const Y={components:{CoreTooltip:O,CoreWpTable:k,Cta:v,KeywordInner:X,Statistic:m,SvgCaret:E},mixins:[w,U,I],data(){return{tableId:"aioseo-search-statistics-keywords-table",activeRow:-1,showUpsell:!1,isPreloading:!1,isFetching:!1,interval:null,strings:{ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Access Control",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Access Control is only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro")}}},props:{keywords:Object,loading:{type:Boolean,default(){return!1}},showHeader:{type:Boolean,default(){return!0}},showTableFooter:Boolean,showItemsPerPage:Boolean,columns:{type:Array,default(){return["keyword","clicks","ctr","impressions","position","diffPosition","buttons"]}},appendColumns:{type:Object,default(){return{}}},postDetail:{type:Boolean,default(){return!1}},refreshOnLoad:{type:Boolean,default(){return!0}},page:{type:String,default(){return""}}},computed:{...y(["isUnlicensed"]),...c("search-statistics",["data","isConnected"]),changeItemsPerPageSlug(){return this.postDetail?"searchStatisticsPostDetailKeywords":"searchStatisticsKeywordRankings"},allColumns(){var s,e;const r=this.columns,t=((e=(s=this.keywords)==null?void 0:s.filters)==null?void 0:e.find(i=>i.active))||{};return this.appendColumns[t.slug||"all"]&&r.push(this.appendColumns[t.slug||"all"]),r},tableColumns(){return[{slug:"keyword",label:this.$t.__("Keyword",this.$td),sortable:this.isSortable,sortDir:this.orderBy==="keyword"?this.orderDir:"asc",sorted:this.orderBy==="keyword"},{slug:"clicks",label:this.$t.__("Clicks",this.$tdPro),width:"80px",sortable:this.isSortable,sortDir:this.orderBy==="clicks"?this.orderDir:"asc",sorted:this.orderBy==="clicks"},{slug:"ctr",label:this.$t.__("Avg. CTR",this.$td),width:"100px",sortable:this.isSortable,sortDir:this.orderBy==="ctr"?this.orderDir:"asc",sorted:this.orderBy==="ctr"},{slug:"impressions",label:this.$t.__("Impressions",this.$tdPro),width:"120px",sortable:this.isSortable,sortDir:this.orderBy==="impressions"?this.orderDir:"asc",sorted:this.orderBy==="impressions"},{slug:"position",label:this.$t.__("Position",this.$tdPro),width:"85px",sortable:this.isSortable,sortDir:this.orderBy==="position"?this.orderDir:"asc",sorted:this.orderBy==="position"},{slug:"diffDecay",label:this.$t.__("Diff",this.$tdPro),width:"95px"},{slug:"diffPosition",label:this.$t.__("Diff",this.$tdPro),width:"80px"},{slug:"buttons",label:"",width:this.hasSlot("buttons")?"240px":"40px"}].filter(r=>this.allColumns.includes(r.slug))},isSortable(){return this.filter==="all"&&this.$isPro&&!this.isUnlicensed}},methods:{...g("search-statistics",["getPagesByKeywords","updateKeywords","updatePostDetailKeywords"]),decodeHTMLEntities:f,isRowActive(r){return r===this.activeRow},toggleRow(r){if(this.activeRow===r){this.activeRow=-1;return}this.activeRow=r},fetchData(r){return this.isPreloading=!1,this.isFetching=!0,this.page!==""&&(r={...r,page:this.page}),this.postDetail?this.updatePostDetailKeywords(r).finally(()=>{this.isFetching=!1}):this.updateKeywords(r).finally(()=>{this.isFetching=!1})},hasSlot(r="default"){return!!this.$slots[r]||!!this.$scopedSlots[r]},shouldLimitText(r){return 120<f(r).length},maybePreloadPages(){if(!(!this.isConnected||this.isPreloading)){if(this.isFetching&&!this.interval){this.interval=setInterval(()=>{this.isFetching||(clearInterval(this.interval),this.maybePreloadPages())},100);return}this.isPreloading=!0,this.preloadPages().then(()=>{this.isPreloading=!1})}},preloadPages(){var i,n,a,d,p;let r=(n=(i=this.data.keywords)==null?void 0:i.paginated)==null?void 0:n.rows;this.postDetail&&(r=(p=(d=(a=this.data.postDetail)==null?void 0:a.keywords)==null?void 0:d.paginated)==null?void 0:p.rows);const t=[];r.forEach(o=>{o.pages||t.push(o.keyword)});const s=[];for(let o=0;o<t.length;o+=10)s.push(t.slice(o,o+10));const e=[];return s.forEach(o=>{e.push(new Promise($=>{this.getPagesByKeywords(o).then(b=>{Object.entries(b).forEach(P=>{const[C,x]=P,u=r.findIndex(T=>T.keyword===C);if(u===-1)return;const h=Object.values(x).slice(0,10);this.postDetail?this.data.postDetail.keywords.paginated.rows[u].pages=h:this.data.keywords.paginated.rows[u].pages=h})}).finally(()=>{$()})}))}),Promise.all(e)}},mounted(){this.maybePreloadPages()},updated(){this.maybePreloadPages()}};var Z=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-search-statistics-keywords-table"},[s("core-wp-table",{ref:"table",staticClass:"keywords-table",attrs:{id:t.tableId,columns:t.tableColumns,rows:Object.values(t.keywords.rows),totals:t.keywords.totals,filters:t.keywords.filters,"additional-filters":t.keywords.additionalFilters,loading:t.loading,"initial-page-number":t.pageNumber,"initial-search-term":t.searchTerm,"initial-items-per-page":t.$aioseo.settings.tablePagination[t.changeItemsPerPageSlug],"show-header":t.showHeader,"show-bulk-actions":!1,"show-table-footer":t.showTableFooter,"show-items-per-page":t.showItemsPerPage,"show-pagination":"","blur-rows":t.showUpsell},on:{"filter-table":t.processFilter,"process-additional-filters":t.processAdditionalFilters,paginate:t.processPagination,"process-change-items-per-page":t.processChangeItemsPerPage,search:t.processSearch,"sort-column":t.processSort},scopedSlots:t._u([{key:"keyword",fn:function({row:e,index:i,editRow:n}){return[s("div",{staticClass:"keyword"},[t.shouldLimitText(e.keyword)?s("core-tooltip",{scopedSlots:t._u([{key:"tooltip",fn:function(){return[t._v(" "+t._s(t.decodeHTMLEntities(e.keyword))+" ")]},proxy:!0}],null,!0)},[s("a",{staticClass:"limit-line",attrs:{href:"#"},on:{click:function(a){a.preventDefault(),n(i),t.toggleRow(i)}}},[t._v(" "+t._s(t.decodeHTMLEntities(e.keyword))+" ")])]):s("a",{attrs:{href:"#"},on:{click:function(a){a.preventDefault(),n(i),t.toggleRow(i)}}},[t._v(" "+t._s(t.decodeHTMLEntities(e.keyword))+" ")])],1)]}},{key:"clicks",fn:function({row:e}){return[t._v(" "+t._s(e.clicks)+" ")]}},{key:"ctr",fn:function({row:e}){return[t._v(" "+t._s(t.$numbers.compactNumber(e.ctr))+"% ")]}},{key:"impressions",fn:function({row:e}){return[t._v(" "+t._s(t.$numbers.compactNumber(e.impressions))+" ")]}},{key:"position",fn:function({row:e}){return[t._v(" "+t._s(Math.round(e.position).toFixed(0))+" ")]}},{key:"diffPosition",fn:function({row:e}){return[s("statistic",{attrs:{type:"position",difference:e.difference.position,showCurrent:!1,"tooltip-offset":"-100px,0"}})]}},{key:"diffDecay",fn:function({row:e}){return[s("statistic",{attrs:{type:"decay",difference:e.difference.decay,showCurrent:!1,"tooltip-offset":"-100px,0"}})]}},{key:"buttons",fn:function({row:e,index:i,column:n,editRow:a}){return[s("div",{},[t._t("buttons",null,{row:e,column:n,index:i}),s("base-button",{staticClass:"toggle-row-button",class:{active:t.isRowActive(i)},attrs:{type:"gray"},on:{click:function(d){a(i),t.toggleRow(i)}}},[s("svg-caret")],1)],2)]}},{key:"edit-row",fn:function({index:e}){return[s("keyword-inner",{attrs:{index:e,postDetail:t.postDetail}})]}},{key:"cta",fn:function(){return[t.showUpsell?s("cta",{attrs:{"cta-link":t.$links.getPricingUrl("search-statistics","search-statistics-upsell"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("search-statistics","search-statistics-upsell","home")},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0}],null,!1,765703614)}):t._e()]},proxy:!0},{key:"tablenav",fn:function(){return[t._t("tablenav")]},proxy:!0}],null,!0)})],1)},tt=[],st=l(Y,Z,tt,!1,null,null,null,null);const et=st.exports,rt={components:{CoreBlur:D,CoreCard:S,GridColumn:R,GridRow:B,KeywordsDistributionGraph:W,KeywordsGraph:A,KeywordsTable:et,SeoStatisticsOverview:F},data(){return{strings:{keywordPositionsCard:this.$t.__("Keyword Positions",this.$td),keywordPositionsTooltip:this.$t.__("This graph is a visual representation of how well <strong>keywords are ranking in search results over time</strong> based on their position and average CTR. This can help you understand the performance of keywords and identify any trends or fluctuations.",this.$td),keywordPerformanceCard:this.$t.__("Keyword Performance",this.$td),keywordPerformanceTooltip:this.$t.__("This table displays the performance of keywords that your site ranks for over time, including metrics such as impressions, click-through rate, and average position in search results. It allows for easy analysis of how keywords are performing and identification of any underperforming keywords that may need to be optimized or replaced.",this.$td)},defaultKeywords:{rows:[],totals:{page:0,pages:0,total:0}}}},computed:{...c("search-statistics",["data"])}};var it=function(){var e,i;var t=this,s=t._self._c;return s("core-blur",[s("div",{staticClass:"aioseo-search-statistics-dashboard"},[s("grid-row",[s("grid-column",[s("core-card",{attrs:{slug:"keywordPositions","header-text":t.strings.keywordPositionsCard,toggles:!1,"no-slide":""},scopedSlots:t._u([{key:"tooltip",fn:function(){return[s("span",{domProps:{innerHTML:t._s(t.strings.keywordPositionsTooltip)}})]},proxy:!0}])},[s("seo-statistics-overview",{attrs:{statistics:["keywords","impressions","position"],"show-graph":!1,view:"side-by-side"}}),s("grid-row",[s("grid-column",{attrs:{md:"6"}},[s("keywords-graph",{attrs:{"legend-style":"simple"}})],1),s("grid-column",{attrs:{md:"6"}},[s("keywords-distribution-graph")],1)],1)],1),s("core-card",{attrs:{slug:"keywordPerformance","header-text":t.strings.keywordPerformanceCard,toggles:!1,"no-slide":""},scopedSlots:t._u([{key:"tooltip",fn:function(){return[s("span",{domProps:{innerHTML:t._s(t.strings.keywordPerformanceTooltip)}})]},proxy:!0}])},[s("keywords-table",{ref:"table",attrs:{keywords:((i=(e=t.data)==null?void 0:e.keywords)==null?void 0:i.paginated)||t.defaultKeywords,"show-items-per-page":"","show-table-footer":""}})],1)],1)],1)],1)])},ot=[],at=l(rt,it,ot,!1,null,null,null,null);const nt=at.exports;const lt={components:{Blur:nt,Cta:v,RequiredPlans:G},data(){return{strings:{ctaButtonText:this.$t.sprintf(this.$t.__("Upgrade to %1$s and Unlock Search Statistics",this.$td),"Pro"),ctaHeader:this.$t.sprintf(this.$t.__("Search Statistics is only for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro"),ctaDescription:this.$t.__("Connect your site to Google Search Console to receive insights on how content is being discovered. Identify areas for improvement and drive traffic to your website.",this.$td),thisFeatureRequires:this.$t.__("This feature requires one of the following plans:",this.$td),feature1:this.$t.__("Search traffic insights",this.$td),feature2:this.$t.__("Track page rankings",this.$td),feature3:this.$t.__("Track keyword rankings",this.$td),feature4:this.$t.__("Speed tests for individual pages/posts",this.$td)}}},computed:{...y(["isUnlicensed"])}};var ct=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-search-statistics-keyword-rankings"},[s("blur"),s("cta",{attrs:{"cta-link":t.$links.getPricingUrl("search-statistics","search-statistics-upsell","keyword-rankings"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("search-statistics","keyword-rankings","home"),"feature-list":[t.strings.feature1,t.strings.feature2,t.strings.feature3,t.strings.feature4],"align-top":""},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[s("required-plans",{attrs:{"core-feature":["search-statistics","keyword-rankings"]}}),t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0}])})],1)},dt=[],ut=l(lt,ct,dt,!1,null,null,null,null);const _=ut.exports,pt={mixins:[L],components:{KeywordRankings:_,Lite:_}};var ht=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-search-statistics-keyword-rankings"},[t.shouldShowMain("search-statistics","keyword-rankings")?s("keyword-rankings"):t._e(),t.shouldShowUpgrade("search-statistics","keyword-rankings")||t.shouldShowLite?s("lite"):t._e()],1)},ft=[],_t=l(pt,ht,ft,!1,null,null,null,null);const Wt=_t.exports;export{Wt as default};
