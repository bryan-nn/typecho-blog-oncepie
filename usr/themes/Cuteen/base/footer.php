<?php

/**
 * Author: Veen Zhao
 * CreateTime: 2020/9/9 23:06
 * 脚部
 */
?>
<?php if (($this->is('post') || $this->is('page')) && ($this->fields->catalog == true)) : ?>
    <div id="TOC-btn">
        <div class="position-relative">
            <div class="p-2">
                <svg class="icon icon-20" aria-hidden="true">
                    <use xlink:href="#list"></use>
                </svg>
                目录
            </div>
            <div class="TOC-ctx">
                <div id="TOC-text" class="TOC-text"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
</main>
<footer id="footer" class="bg-white p-4 text-center">
    <p class="small">
        &copy; <?php echo date('Y'); ?>
        <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    </p>
    <?php if ($this->options->备案号) : ?>
        <p class="small">
            <svg class='icon icon-20' aria-hidden='true'>
                <use xlink:href='#ICP'></use>
            </svg>
            <a href="https://beian.miit.gov.cn/#/Integrated/index" target="_blank"> <?php $this->options->备案号() ?></a>
        </p>
    <?php endif; ?>
    <?php if ($this->options->公安备案号) : ?>
        <p class="small">
            <svg class='icon icon-20' aria-hidden='true'>
                <use xlink:href='#guohui'></use>
            </svg>
            <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php echo preg_replace('/[^\d]*/', '', $this->options->公安备案号) ?>"><?php $this->options->公安备案号() ?></a>
        </p>
    <?php endif; ?>
    <!-- 此处版权可以修改或删除，建议保留，谢谢 -->
    <p class="small"> Powered by <a href="http://typecho.org" target="_blank">Typecho</a> ※ Theme is <a href="https://blog.zwying.com" target="_blank">Cuteen</a></p>
</footer>
<div id="mask" onclick="Cuteen.bodyClose()" data-mask="close"></div>

<!-- 搜索框 -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title h5" id="searchModalLabel" for="searchNameAccept">搜点什么……</label>
            </div>
            <div class="modal-body">
                <input autocomplete="off" onkeydown="Cuteen.enterSearch(this)" id="searchNameAccept" class="form-control" name="s" type="text" placeholder="请输入搜索关键词……" required />
            </div>
            <div class="modal-footer">
                <button id="closeSearch" type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="Cuteen.startSearch(document.getElementById('searchNameAccept'))">点我搜索
                </button>
            </div>
        </div>
    </div>
</div>

<div class="mobile-right-btn">
    <?php if ($this->options->是否启用歌单解析) : ?>
        <!--    移动端播放器-->
        <div id="mobileMusic" class="right-btn-icon position-relative d-block d-sm-none">
            <svg class="icon icon-20" aria-hidden="true">
                <use xlink:href="#music"></use>
            </svg>
            <div id="musicMobileBox"></div>
        </div>
    <?php endif; ?>
    <!--移动端昼夜切换-->
    <div onclick="Cuteen.darkMode()" class="right-btn-icon d-block d-sm-none">
        <svg class="icon icon-20" aria-hidden="true" id="mobileDarkMode">
            <use xlink:href="#moon"></use>
        </svg>
    </div>
    <!--    返回顶部-->
    <div class="right-btn-icon" onclick="Cuteen.backTop()">
        <svg class="icon icon-20" aria-hidden="true" id="darkMode">
            <use xlink:href="#arrow-up"></use>
        </svg>
    </div>
</div>
<script src="<?= StaticPath . 'js/bundle-4fa6579164.js'; ?>"></script>
<!--代码高亮-->
<script src="<?= StaticPath . 'js/clipboard.min.js'; ?>"></script>
<script src="<?= StaticPath . 'js/highlight.min.js'; ?>"></script>
<script src="<?= StaticPath . 'js/highlightjs-line-numbers.min.js'; ?>"></script>
<?php if ($this->options->数学公式渲染) : ?>
    <script no-pjax async id="MathJax-script" src="<?= StaticPath . 'js/tex-mml-chtml.js'; ?>"></script>
    <script no-pjax>
        MathJax = {
            options: {
                renderActions: {
                    addMenu: [0, "", ""]
                }
            },
            tex: {
                inlineMath: [
                    ["$", "$"],
                    ["\\(", "\\)"]
                ]
            },
            svg: {
                fontCache: "global"
            }
        }
    </script>
<?php endif; ?>
<script type="text/javascript">
    lightGallery(document.getElementById("comment-list"), {
        selector: '.lightbox'
    });
    lightGallery(document.getElementById("post"), {
        selector: '.lightbox'
    });
</script>

<?php if ($this->options->Pjax无刷新) : ?>
    <script src="<?= StaticPath . 'js/pjax-api.min.js'; ?>"></script>
    <script no-pjax>
        var _require = require('pjax-api'),
            Pjax = _require.Pjax;
        new Pjax({
            areas: ['#header,#main','#main'],
            link: ['a:not(.next)'],
            update: {
                ignore: '[no-pjax]'
            }
        });
        window.addEventListener('pjax:fetch', function() {
            NProgress.set(0.6);
        });
        document.addEventListener('pjax:ready', function() {
            PjaxLoad();
            <?php if ($this->options->数学公式渲染) : ?>
                MathJax.typeset();
            <?php endif; ?>
            <?php if ($this->options->pjax回调) : $this->options->pjax回调(); ?><?php endif; ?> 
            NProgress.done();
        });
    </script>
<?php endif; ?>

<script src="<?= StaticPath . 'js/app.js'; ?>"></script>
<?php if ($this->options->是否启用歌单解析) : ?>
    <script src="<?= StaticPath . 'js/skPlayer.js'; ?>"></script>
<?php endif; ?>
<?php if ($this->options->平滑滚动) : ?>
    <script src="<?= StaticPath . 'js/SmoothScroll.min.js'; ?>"></script>
<?php endif; ?>
<script>
    if ('serviceWorker' in navigator) {
        <?php if ($this->options->sw) : ?>
            navigator.serviceWorker.register('/serviceWorker.js')
                .then(function(reg) {}).catch(function(error) {
                    console.log('cache failed with ' + error); // registration failed
                });
            navigator.serviceWorker.addEventListener('controllerchange', function(ev) {
                try {
                    Toastify({
                        text: "检测到本地缓存需要更新",
                        backgroundColor: "var(--bs-info)",
                    }).showToast();
                } catch (e) {
                    console.log("controllerchange");
                }
            });
        <?php else : ?>
            navigator.serviceWorker.getRegistrations()
                .then(function(registrations) {
                    for (let registration of registrations) {
                        registration.unregister();
                        // 清除缓存
                        window.caches && caches.keys && caches.keys().then(function(keys) {
                            keys.forEach(function(key) {
                                caches.delete(key);
                            });
                        });
                        console.log("unregister success")
                    }
                });
        <?php endif; ?>
    }
</script>
<?php $this->footer(); ?>
<?php if ($this->options->底部自定义) : $this->options->底部自定义(); ?><?php endif; ?>
</body>

</html>
<?php if ($this->options->Html压缩输出) : $html_source = ob_get_contents();
    ob_clean();
    print compressHtml($html_source);
    ob_end_flush();
endif; ?>