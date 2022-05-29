pipeline {
     agent any
     stages {
        stage("Build") {
            steps {
                slackSend channel: 'fanclub-jenkins-alerts', message: 'BUILD START: Job Fanclub-BE'
                // sh "sudo mv ${WORKSPACE}/.env.prod ${WORKSPACE}/.env"
                sh "composer install"
                sh "php artisan optimize"
                // sh "sudo php artisan migrate"
                // sh "sudo php artisan db:seed"
                sh "sudo chmod -R 777 ${WORKSPACE}"
            }
        }
        stage("Deploy") {
            steps {
                
                sh "sudo rm -rf /var/www/j-platform/*"
                sh "sudo mkdir -p /var/www/j-platform"
                sh "sudo cp -r ${WORKSPACE}/. /var/www/j-platform"
                sh "sudo chown -R nginx:nginx /var/www/j-platform"
                sh "sudo systemctl reload nginx"
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
