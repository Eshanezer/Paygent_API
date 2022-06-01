pipeline {
     agent any
     stages {
        stage("Build") {
            steps {
                slackSend channel: 'fanclub-jenkins-alerts', message: 'BUILD START: Job Fanclub-BE'
                // sh "sudo mv ${WORKSPACE}/.env.prod ${WORKSPACE}/.env"
                sh "composer install"
                // sh "php artisan optimize"
                // sh "sudo php artisan migrate"
                // sh "sudo php artisan db:seed"
                sh "sudo chmod -R 777 ${WORKSPACE}"

                sh "sudo cp /var/www/do_not_delete/.env.backup ${WORKSPACE}"
                sh "sudo mv ${WORKSPACE}/.env.backup ${WORKSPACE}/.env"

                sh "sudo chmod -R 777 ${WORKSPACE}/.env"
                sh "php artisan key:generate"
                sh "php artisan config:cache"
                sh "php artisan route:cache"
                sh "php artisan view:cache"

            }
        }
        stage("Deploy") {
            steps {

                sh "sudo rm -rf /var/www/j-platform/*"
                sh "sudo mkdir -p /var/www/j-platform"
                sh "sudo cp -r ${WORKSPACE}/. /var/www/j-platform"
                sh "sudo chown -R nginx:nginx /var/www/j-platform"
                sh "sudo systemctl reload nginx"

                // sh "sudo rm -rf /var/www/j-platform/*"
                // sh "sudo mkdir -p /var/www/j-platform"

                // sh "sudo chown -R nginx:nginx /var/www/j-platform"

                // sh "sudo cp /var/www/do_not_delete/.env.backup ${WORKSPACE}"
                // sh "sudo mv ${WORKSPACE}/.env.backup ${WORKSPACE}/.env"

                // sh "sudo chmod -R 777 ${WORKSPACE}/.env"
                // sh "php artisan key:generate"
                // sh "php artisan config:cache"
                // sh "php artisan route:cache"
                // sh "php artisan view:cache"

                // sh "sudo cp -r ${WORKSPACE}/. /var/www/j-platform"
                // sh "sudo chmod -R 777 /var/www/j-platform/storage"
                // sh "sudo systemctl reload nginx"



            }
        }
    }
    post {
        success {
          slackSend channel: 'fanclub-jenkins-alerts', color: '#00FF00', message: 'SUCCESSFUL: Job Fanclub-BE'
        }

        failure {
          slackSend channel: 'fanclub-jenkins-alerts', color: '#FF0000', message: 'FAILED: Job Fanclub-BE'
        }
    }
}
