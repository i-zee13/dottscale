<style>
    .top-border{border-top: solid 2px #EBB30A; border-radius: 0;}

.publish{
    background-color: #040725;
    font-size: 14px;
    letter-spacing: 1px;
    border-radius: 0;
    line-height: 1;
    padding: 8px 20px;
    border: solid 1px #040725;
 color: #fff !important;
}

.draft{
background-color: #fff;
    font-size: 14px;
    letter-spacing: 1px;
    border-radius: 0;
    line-height: 1;
    padding: 8px 20px;
    border: solid 1px #040725;
    color: #040725 !important;
}

    </style><div id="phpb-loading">
    <div class="circle">
        <div class="loader">
            <div class="loader">
                <div class="loader">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
        <div class="text">
            Loading Pagebuilder...
        </div>
    </div>
</div>

<div id="gjs"></div>

<!-- <script type="text/javascript" src="https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js"></script> -->
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<!-- <script type="text/javascript" src="<?= phpb_asset('pagebuilder/ckeditor.js') ?>"></script> -->
<script type="text/javascript" src="<?= phpb_asset('pagebuilder/grapesjs-plugin-ckeditor-v0.0.9.min.js') ?>"></script>
<script type="text/javascript" src="<?= phpb_asset('pagebuilder/grapesjs-touch-v0.1.1.min.js') ?>"></script>
<script type="text/javascript">
    CKEDITOR.dtd.$editable.a = 1;
    CKEDITOR.dtd.$editable.b = 1;
    CKEDITOR.dtd.$editable.em = 1;
    CKEDITOR.dtd.$editable.button = 1;
    CKEDITOR.dtd.$editable.strong = 1;
    CKEDITOR.dtd.$editable.small = 1;
    CKEDITOR.dtd.$editable.span = 1;
    CKEDITOR.dtd.$editable.ol = 1;
    CKEDITOR.dtd.$editable.ul = 1;
    CKEDITOR.dtd.$editable.table = 1;
    CKEDITOR.dtd.$editable.aside = 1;
    CKEDITOR.dtd.$editable.figure = 1;
    CKEDITOR.dtd.$editable.figcaption = 1;

    window.languages = <?= json_encode(phpb_active_languages()) ?>;
    window.currentLanguage = <?= in_array(phpb_config('general.language'), phpb_active_languages()) ? json_encode(phpb_config('general.language')) : json_encode(array_keys(phpb_active_languages())[0]) ?>;
    window.translations = <?= json_encode(phpb_trans('pagebuilder')) ?>;
    window.contentContainerComponents = <?= json_encode($pageBuilder->getPageComponents($page)) ?>;
    window.themeBlocks = <?= json_encode($blocks) ?>;
    window.blockSettings = <?= json_encode($blockSettings) ?>;
    window.pageBlocks = <?= json_encode($pageRenderer->getPageBlocksData()) ?>;
    window.pages = <?= json_encode($pageBuilder->getPages()) ?>;
    window.renderBlockUrl = '<?= phpb_url('pagebuilder', ['action' => 'renderBlock', 'page' => $page->getId()]) ?>';
    window.injectionScriptUrl = '<?= phpb_asset('pagebuilder/page-injection.js') ?>';
    window.renderLanguageVariantUrl = '<?= phpb_url('pagebuilder', ['action' => 'renderLanguageVariant', 'page' => $page->getId()]) ?>';

    <?php
    $config = require __DIR__ . '/grapesjs/config.php';
    ?>
    let config = <?= json_encode($config) ?>;
    if (window.customConfig !== undefined) {
        config = $.extend(true, {}, window.customConfig, config);
    }

    window.initialComponents = <?= json_encode($pageRenderer->render()) ?>;
    window.initialStyle = <?= json_encode($pageBuilder->getPageStyleComponents($page)) ?>;
    window.grapesJSTranslations = {
        <?= phpb_config('general.language') ?>: {
            styleManager: {
                empty: '<?= phpb_trans('pagebuilder.style-no-element-selected') ?>'
            },
            traitManager: {
                empty: '<?= phpb_trans('pagebuilder.trait-no-element-selected') ?>',
                label: '<?= phpb_trans('pagebuilder.trait-settings') ?>',
                traits: {
                    options: {
                        target: {
                            false: '<?= phpb_trans('pagebuilder.no') ?>',
                            _blank: '<?= phpb_trans('pagebuilder.yes') ?>'
                        }
                    }
                }
            },
            assetManager: {
                addButton: '<?= phpb_trans('pagebuilder.asset-manager.add-image') ?>',
                inputPlh: 'http://path/to/the/image.jpg',
                modalTitle: '<?= phpb_trans('pagebuilder.asset-manager.modal-title') ?>',
                uploadTitle: '<?= phpb_trans('pagebuilder.asset-manager.drop-files') ?>'
            }
        }
    };

    window.grapesJSLoaded = false;
    window.editor = window.grapesjs.init(config);
    window.editor.on('load', function(editor) {
        window.grapesJSLoaded = true;
    });
    window.editor.I18n.addMessages(window.grapesJSTranslations);

    // load the default or earlier saved page css components
    editor.setStyle(window.initialStyle);
</script>

<?php
require __DIR__ . '/grapesjs/asset-manager.php';
require __DIR__ . '/grapesjs/component-type-manager.php';
require __DIR__ . '/grapesjs/style-manager.php';
require __DIR__ . '/grapesjs/trait-manager.php';
?>

<button id="toggle-sidebar" class="btn">
    <i class="fa fa-bars"></i>
</button>
<div id="sidebar-header">
    <?php
    if (sizeof(phpb_active_languages()) > 1) :
    ?>
        <div id="language-selector">
            <select class="selectpicker" data-width="fit">
                <?php
                foreach (phpb_active_languages() as $languageCode => $languageTranslation) :
                ?>
                    <option value="<?= phpb_e($languageCode) ?>" <?= phpb_config('general.language') === $languageCode ? 'selected' : '' ?>><?= phpb_e($languageTranslation) ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
    <?php
    endif;
    ?>
    <div style="position:absolute; left:45px; top:6px;"><img style="height:27px" src="/images/allomate-logo-w.svg" alt=""></div>

</div>

<div id="sidebar-bottom-buttons">
    <a    class="btn openStatuDailog"  data-toggle="modal" data-target="#deleteModal" id="hidden_btn_to_open_modal">
        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        <i class="fa fa-save"></i>
        <?= phpb_trans('pagebuilder.save-page') ?>
    </a>

    <a id="view-page" href="<?= phpb_e(phpb_full_url($page->getRoute())) ?>" target="_blank" class="btn">
        <i class="fa fa-external-link"></i>
        <?= phpb_trans('pagebuilder.view-page') ?>
    </a>

    <a id="go-back" href="<?= phpb_e(phpb_full_url(phpb_config('pagebuilder.actions.back'))) ?>" class="btn">
        <i class="fa fa-arrow-circle-left"></i>
        <?= phpb_trans('pagebuilder.go-back') ?>
    </a>
</div>

<div id="block-search">
    <i class="fa fa-search"></i>
    <input type="text" class="form-control" placeholder="Filter">
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content top-border">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Page Status <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <p id="modal_text">Please Select Status</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <a  href="javascript:void(0);"   class="btn draft save-page" data-value="1" data-id="<?= $page->getId() ?>"
                data-url="<?= phpb_url('pagebuilder', ['action' => 'store', 'page' => $page->getId()]) ?>">Draft</a>

                <a  href="javascript:void(0);"   class="btn publish save-page"  data-value="2" data-id="<?= $page->getId() ?>"
                data-url="<?= phpb_url('pagebuilder', ['action' => 'store', 'page' => $page->getId()]) ?>">Publish</a>

            </div>
        </div>
    </div>

</div>
<script>
$(document).ready(function(){
    // document.referrer
    var referrer =  document.referrer;
    $('.save-page').on('click',function(){
        var status  =   $(this).attr('data-value');
        var page_id =   $(this).attr('data-id');
        $.ajax({
            type    :   "post",
            url     :   '/admin/save-page-with-status/'+page_id,
            data    :   {'status': status },
            success :   function(response){
                
                    // window.history.back();
                setTimeout(function () {
                window.location = referrer;
                },3000);
                $('.close').click();
                

            }
        });
    });
});
</script>


