require_once(__DIR__.'/../vendor/hh_autoload.hh');

<<__EntryPoint>>
function main() : noreturn {
    // allow react to read in to the server
    header("Access-Control-Allow-Origin: http://localhost:3000");
    \Facebook\AutoloadMap\initialize();
    echo <react-component componentType="Greeting" componentProps="{&quotname&quot: &quotMike&quot}" />;
    exit(0);
}
