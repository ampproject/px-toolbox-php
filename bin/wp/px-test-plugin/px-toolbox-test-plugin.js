// Change the primary nav height and simulate a CLS issue.
document.addEventListener( 'DOMContentLoaded', function() {
    var element = document.createElement( 'style' );
    element.textContent = 'body {--wp--custom--spacing--small: 1px;}';
    document.body.appendChild( element );
} );

// Trigger "No issues in the Issues panel in Chrome Devtools" error.
console.error( 'Test Error' );
