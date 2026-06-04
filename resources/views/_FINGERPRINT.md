# 设计指纹 - papendrecht.net

## 截图观察要点

### index.png
- 双层导航：顶层白底（Logo + slogan），底层深绿色（#157b6f）主菜单
- 页面无 Hero 区；左列大图卡片（item-big）+ 右列分类聚合 + 右侧热门侧边栏
- 卡片图片左上角有日期角标（深绿色背景），hover 时图片有暗色遮罩+文字上移
- item-small：深色背景日期块 + 浅色标题块，横排 flex 布局
- Footer：深绿色背景（#116359），3列（Company / Resource / Legal）+ 底部版权行

### category.png
- Header 内有面包屑导航（#breadcrumbs），绿色背景
- 顶部行：H1 + 分类下拉选择器
- 2列文章网格（item-big），右侧热门文章侧边栏
- 数字分页组件

### article.png
- 窄主内容区 + 右侧 more-items 侧边栏
- 文章头部：H1 + 日期/作者/分类 meta
- FAQ 区域：手风琴展开式（点击 H3 展开 .faq-answer）
- 无 head_img 单独展示（禁止渲染）

---

## 配色
- 主色：`#157b6f`（导航底条、按钮、链接高亮、日期角标）
- 辅色/强调色：`#116359`（footer-bottom 背景、hover 深化）
- 背景色：`#f8f9fa`（页面主背景）
- 内容区背景：`#ffffff`（卡片、主内容）
- 文字色：`#333333`（正文）
- 标题色：`#212529`
- 链接色：`#157b6f` / 链接 hover 色：`#0d5e54`
- 分隔线/边框色：`#dee2e6`

## 字体
- 标题字体族：Arial, Helvetica, sans-serif
- 正文字体族：Arial, Helvetica, sans-serif
- 导航字体族：Arial, Helvetica, sans-serif
- 字体来源：系统字体（无 Google Fonts）
- 正文字号参考：15-16px
- 行高参考：1.6

## HTML DOM 骨架

- layout（body 顶层）：`header > nav(#nav-top + #nav-bottom) + #breadcrumbs` → `main` → `footer(#footer-top + #footer-bottom)`
- nav 为独立标签，不套在 `<header>` 内的 `<div>`，直接子级即 `#nav-top` 和 `#nav-bottom`
- `#breadcrumbs` 在 `</nav>` 之后、`</header>` 之前，仅分类/静态页有，首页/文章页无
- 首页 content：`<div id="home"> → .container → .row → .left + .right + .a-sidebar`
- 分类页 content：`<div id="news-overview" class="container"> → .row → .page-content + .a-sidebar`
- 文章页 content：`<div class="container"> → .row → .detail-content + .more-items`

## 模块取舍

- 顶栏/导航：有；双条（#nav-top 白底 + #nav-bottom 绿底）；在 header 内
- Hero / 焦点头条区：无
- 首页文章列表形态：左列 item-big + item-small 混合，右列分类聚合，右侧热门侧边栏
- 首页分类聚合区块：有（.right 列按分类分 section，每组含 item-big + item-small）
- 侧边栏：有（.a-sidebar，首页/分类页均有热门文章块）
- Footer：有；3列（Company/Resource/Legal）

## 交互取舍

- 移动菜单：有；汉堡按钮（#menu-toggle）触发 #main-menu.open；#close-menu 关闭
- 返回顶部：无（source 未发现）
- 搜索交互：有；#search-toggle 触发 #search-form.open
- FAQ 手风琴：有；点击 `.faq-item h3` 切换 `.faq-answer.open`
- 下拉菜单：有；`.toggle-button.with-children[data-toggle]`

## 类名与资源路径模式

- source 典型 class/id 模式：短语义 + 功能型（`item-big`, `item-small`, `a-sidebar`, `nav-top`, `nav-bottom`, `hot-item`），无站点前缀
- 禁止使用的自造模式：`papendrecht-*` / `theme-*` / `site-*` 全套前缀
- source CSS 路径：`/css/app.css` → 产出：`public/css/app.css`
- source JS 路径：`/js/main.js` → 产出：`public/js/main.js`

## 版式骨架

### 首页
- 整体布局：三栏（.left + .right + .a-sidebar）
- Header：白色顶条 + 绿色底条，非透明，非粘性
- Hero 区：无
- 文章卡片排列：竖排（item-big 图上文下）+ 横排（item-small 日期左文字右）混合
- 各板块分区：Latest news (.left) → Category sections (.right) → Hot topics (.a-sidebar)
- Footer：3列 + 版权行

### 分类列表页
- 布局：主内容区（左宽） + 侧边栏（右窄）
- 文章卡片样式：2列 item-big 网格
- 侧边栏内容：热门文章列表

### 文章详情页
- 主内容区宽度：窄栏阅读（约 70% 宽）
- 侧边栏：右侧 .more-items（热门文章）
- 正文排版：标准段落，行高 1.7
- 文章头部：H1 + 发布时间 + 作者 + 分类标注
- FAQ 区域：有；手风琴折叠（点击 H3 切换 .faq-answer.open）
- 相关文章区：有（$relatedBlogs，网格卡片）

## 卡片风格
- 圆角：小 4px
- 阴影：浅（0 2px 8px rgba(0,0,0,.08)）
- 边框：无（item-big）；细线（item-small）
- 图片比例：16:9（item-big ~275px 固定高度）
- Hover 效果：图片暗色遮罩 + 标题颜色变化

## 导航风格
- 位置：顶部非粘性
- 背景：顶条白色 / 底条 #157b6f 绿色
- Logo 位置：左
- 下拉菜单：有（桌面端）
- 移动端折叠方式：汉堡菜单（#menu-toggle → #main-menu.open）

## 调性关键词
新闻门户、清新绿调、实用简洁

## 特殊视觉细节
- item-big 左上角日期角标：绑定图片容器，绿色背景白字，两行（日/月）
- item-small：深色（#212529）日期块带右箭头装饰，浅色文字块
- #nav-bottom 绿色条：菜单项白色文字，hover 加下划线或背景略深
- Footer 统一深绿色背景，链接白色

---

## 静态资源命名方案
- 标识符：`papendrecht`（用于 partial 文件名注释等；不作为目录前缀）
- 样式文件路径清单：
  - `public/css/app.css` → 全站样式（变量、reset、nav、footer、卡片、首页、分类、文章、静态页、404、响应式）
- 脚本文件路径清单：
  - `public/js/main.js` → 全站交互（移动菜单、下拉菜单、搜索、FAQ 手风琴）
- CSS 类名风格：短语义 + 功能型；无站点前缀；与 source class 模式一致
- Partial 文件命名风格示例：`newsitem`（文章卡片）、`breadcrumb`、`pagination`、`article-list`

---

## 版式变体决策

- Hero 区：无（source 首页无 Hero）
- 文章卡片排列：首页混合（item-big + item-small）；分类页 2列 item-big 网格
- 分类页侧边栏：右侧
- 分页方式：数字分页（含 AJAX article-list partial 支持）
- 首页分区数量：3区（Latest news / Category groups / Hot topics sidebar）

---

## 自检结果

- [x] _FINGERPRINT.md 已生成，含完整指纹与资源命名方案
- [x] 每个页面有且只有一个 H1
- [x] H 标签层级无跳跃（H1→H2→H3，无 H4+）
- [x] FAQ 区域仅在有数据时渲染，FAQ 区块标题使用 H2，每条问题使用 H3
- [x] 面包屑最后一项无 `<a>` 标签（不可点击）
- [x] 面包屑字段用的是 `$crumb['absolute_url']`，不是 `$crumb['url']`
- [x] 所有 `<img>` 均有非空 alt 属性
- [x] 文章详情页未渲染 `$blog->head_img`（无单独 `<img>` 输出；仅 article-body 内 content HTML 可能含图）
- [x] 无任何 penci-* / wp-block-* / magcat-* 类名
- [x] 面包屑 HTML 中无 itemprop / itemscope / itemtype 属性
- [x] 无 javascript:void(0) 链接
- [x] 无 `<a>` 标签嵌套（newsitem 使用 CSS overlay 技巧）
- [x] 移动端导航通过 click 而非 hover 触发
- [x] CSS 类名命名体系全文一致（短语义，无站点前缀）
- [x] 资源引用使用 asset() 函数，无硬编码路径
- [x] Blade 注释使用 `{{-- --}}`，无 HTML 注释
- [x] partials/article-list.blade.php 存在（供 AJAX 调用）
- [x] 分页链接为真实 URL（paginator->url($p)）
- [x] JSON-LD 覆盖：首页 WebSite、分类 CollectionPage+BreadcrumbList、文章 Article+BreadcrumbList；FAQPage 仅在 $blog->faq 非空时输出
- [x] `<html lang>` 使用 `app()->getLocale()`
- [x] `$alternate_tag` 在 `<head>` 中输出
- [x] 产出风格与 source 指纹匹配；截图观察要点已记录
- [x] DOM：layout/各页 content 嵌套对齐 source（header>nav+breadcrumbs, main, footer）
- [x] 类名：延续 source 命名模式（item-big, item-small, a-sidebar…），无自造前缀体系
- [x] 资源路径：`css/app.css` 和 `js/main.js` 对照 source link/script 标签
- [x] 反模板库：无强加 Hero；DOM 结构由 source 指纹驱动，换 source 会产出不同骨架
