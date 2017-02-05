module.exports = {
    buildCmd:{
        command: [
            'php bin/console cache:clear --env=dev',
            'sudo rm -rf var/cache/dev/*'
        ].join('&&')
    },
    buildCmdProd:{
        command: [
            'php bin/console cache:clear --env=prod',
            'sudo rm -rf var/cache/prod/*'
        ].join('&&')
    }
};