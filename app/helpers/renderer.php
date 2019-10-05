<?php
declare(strict_types=1);
namespace Olimpuss\Helpers;
umask(0000);


// learn The Twig Text Extension: https://twig-extensions.readthedocs.io/en/latest/index.html

class Renderer {
  /**
   * @var \Twig_Environment $twigRender
   * Singleton var to avoid multiple twigrender instances.
   */
  protected static $twigRender = NULL;
  /**
   * Initialize twigRender if is not created before.
   *
   * @return \Twig_Environment
   */
  public static function getTwigRender() {
    // Check if render exists.
    if (empty(self::$twigRender)) {
      // Load directory of templates.
      $loader = new \Twig_Loader_Filesystem([
        SITELAYOUT,
        LAYOUTS.'globals'.DIRECTORY_SEPARATOR
      ]);
      // Initialize environment with custom configurations.
      self::$twigRender = new \Twig_Environment($loader, [
          'cache' =>  STORAGE . 'cache',
          'debug' => TRUE,
          'auto_escape' => FALSE,
          'autoescape' => FALSE,
          'charset' => 'UTF-8',
          'strict_variables' => TRUE,
          'auto_reload' => ! (APP_ENV == 'production')
        ]
      );
    }
    return self::$twigRender;
  }
  /**
   * Render template and returns it content.
   *
   * @param $templateName
   *   Template file name.
   * @param array $variables
   *   Variables to include on template.
   *
   * @return string
   *  Template content.
   */
  public static function renderTemplate($templateName, $variables = array()) {
    $twigRender = self::getTwigRender();
    $renderedContent = '';
    $defsValues = [
        'CFG_manifest' => mix('manifest.json'),
        'BASE_URL' => BASE_URL,
        'PATH_URL' => BASE_URL,
        'CFG_LOCALEISO' => 'es',
        'APP_AUTHOR' => APP_AUTHOR,
        'APP_COPYRIGHT' => APP_COPYRIGHT,
        'GOOGLE_CLIENTID' => GOOGLE_CLIENTID ?? '',
        'GOOGLE_SITEVERIFY' => GOOGLE_SITEVERIFY ?? '',
        'FB_APP_ID' => FB_APP_ID ?? '',
        'FB_ADMIN_ID' => FB_ADMIN_ID ?? '',
        'FB_ADDRESS' => FB_ADDRESS ?? '',
        'FB_LOCALITY' => FB_LOCALITY ?? '',
        'FB_POSTALCODE' => FB_POSTALCODE ?? '',
        'FB_COUNTRY' => FB_COUNTRY ?? '',
        'FB_LATITUDE' => FB_LATITUDE ?? '',
        'FB_LONGITUDE' => FB_LONGITUDE ?? '',
        'TW_PROFILE' => TW_PROFILE ?? '',
        'TW_AUTHOR' => TW_AUTHOR ?? '',
        'APP_GTM' => APP_GTM ?? 'GTM-OLIMPUSS',
        'CSRF_TOKEN' => $GLOBALS['CSRF_TOKEN'] ?? sha1(date('Y-m-d H:i:s p')),
        'CFG_DESCAPP' => $GLOBALS['CFG_DESCAPP']  ?? 'Olimpus Soft Desarrollo de Software',
        'CFG_KEYWAPP' => ($GLOBALS['CFG_KEYWAPP']  ?? ''). ', Miguel, Angel, Morales, Coterio, 19705040, 1012461973, face, facebook, Desarrollo, de, Software, Desarrollo de, Desarrollo de Software',
        'CFG_TITLEAPP' => $GLOBALS['CFG_TITLEAPP'] ?? 'Olimpus Soft',
        'CFG_LOGOAPP' => $GLOBALS['CFG_LOGOAPP'] ?? $GLOBALS['CFG_LOGOAPP'] ?? '/assets/imgs/logo.png',

      ];
    try {
      $variables = array_merge($defsValues, $variables);
      $renderedContent = $twigRender->render($templateName . '.mamco.php', $variables);
    } catch (\Twig_Error $e) {
      // we can include any php log for our application.
      $errv = array_merge($defsValues, ['message' => $e->getMessage(), 'data' => $variables]);
      $renderedContent = $twigRender->render('error.mamco.php', $errv);
    }
    return $renderedContent;
  }
}