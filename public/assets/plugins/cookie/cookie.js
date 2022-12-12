

$(document).ready(function () {
    $('body').ihavecookies({
        title: '&#x1F36A; Accepter les cookies et la politique de confidentialité ?',
        message: "Il n'y a pas de cookies utilisés sur ce site, mais s'il y en avait, ce message pourrait être personnalisé pour fournir plus de détails. Cliquez sur le bouton <strong>accepter</strong> ci-dessous pour voir le rappel facultatif en action...",
        delay: 600,
        expires: 1,
        link: '#privacy',
        onAccept: function () {
            var myPreferences = $.fn.ihavecookies.cookie();
            console.debug('Yay! The following preferences were saved...');
            console.debug(myPreferences);
        },
        uncheckBoxes: true,
        acceptBtnLabel: 'Accepter Cookies',
        moreInfoLabel: 'En savoir plus'
    });

    if ($.fn.ihavecookies.preference('marketing') === true) {
        console.debug('This should run because marketing is accepted.');
    }
});
