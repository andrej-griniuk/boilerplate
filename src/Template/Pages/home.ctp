<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace src/Template/Pages/home.ctp with your own version or re-enable debug mode.'
    );
endif;

$this->assign('title', __('Welcome to CakePHP {0} Red Velvet. Build fast. Grow solid.', Configure::version()));
?>
<div class="alert alert-warning" role="alert">
    Please be aware that this page will not be shown if you turn off debug mode unless you replace src/Template/Pages/home.ctp with your own version.
</div>
<?php Debugger::checkSecurityKeys(); ?>

<div class="row">
    <div class="col-md-6">
        <h4>Environment</h4>
        <?php if (version_compare(PHP_VERSION, '5.6.0', '>=')) : ?>
            <div class="alert alert-success" role="alert">Your version of PHP is 5.6.0 or higher (detected <?= PHP_VERSION ?>).</div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Your version of PHP is too low. You need PHP 5.6.0 or higher to use CakePHP (detected <?= PHP_VERSION ?>).</div>
        <?php endif; ?>

        <?php if (extension_loaded('mbstring')) : ?>
            <div class="alert alert-success" role="alert">Your version of PHP has the mbstring extension loaded.</div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Your version of PHP does NOT have the mbstring extension loaded.</div>;
        <?php endif; ?>

        <?php if (extension_loaded('openssl')) : ?>
            <div class="alert alert-success" role="alert">Your version of PHP has the openssl extension loaded.</div>
        <?php elseif (extension_loaded('mcrypt')) : ?>
            <div class="alert alert-success" role="alert">Your version of PHP has the mcrypt extension loaded.</div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Your version of PHP does NOT have the openssl or mcrypt extension loaded.</div>
        <?php endif; ?>

        <?php if (extension_loaded('intl')) : ?>
            <div class="alert alert-success" role="alert">Your version of PHP has the intl extension loaded.</div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Your version of PHP does NOT have the intl extension loaded.</div>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <h4>Filesystem</h4>
        <?php if (is_writable(TMP)) : ?>
            <div class="alert alert-success" role="alert">Your tmp directory is writable.</div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Your tmp directory is NOT writable.</div>
        <?php endif; ?>

        <?php if (is_writable(LOGS)) : ?>
            <div class="alert alert-success" role="alert">Your logs directory is writable.</div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Your logs directory is NOT writable.</div>
        <?php endif; ?>

        <?php $settings = Cache::getConfig('_cake_core_'); ?>
        <?php if (!empty($settings)) : ?>
            <div class="alert alert-success" role="alert">The <em><?= $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">Your cache is NOT working. Please check the settings in config/app.php</div>
        <?php endif; ?>
    </div>
    <hr />
</div>

<div class="row">
    <div class="col-md-6">
        <h4>Database</h4>
        <?php
        try {
            $connection = ConnectionManager::get('default');
            $connected = $connection->connect();
        } catch (Exception $connectionError) {
            $connected = false;
            $errorMsg = $connectionError->getMessage();
            if (method_exists($connectionError, 'getAttributes')) :
                $attributes = $connectionError->getAttributes();
                if (isset($errorMsg['message'])) :
                    $errorMsg .= '<br />' . $attributes['message'];
                endif;
            endif;
        }
        ?>
        <?php if ($connected) : ?>
            <div class="alert alert-success" role="alert">CakePHP is able to connect to the database.</div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">CakePHP is NOT able to connect to the database.<br /><?= $errorMsg ?></div>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <h4>DebugKit</h4>
        <?php if (Plugin::loaded('DebugKit')) : ?>
            <div class="alert alert-success" role="alert">DebugKit is loaded.</div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">DebugKit is NOT loaded. You need to either install pdo_sqlite, or define the "debug_kit" connection name.</div>
        <?php endif; ?>
    </div>
    <hr />
</div>
