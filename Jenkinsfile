node {

    stages {
        stage('Checkout') {
            steps {
                deleteDire();
		        checkout scm;
            }
        }
        stage('Build and running container') {
            steps {
                imageApache	= docker.build('server-apache-dev', '--no-cache -f docker/build/apache/Dockerfile');
		        containerApache = imageApache.run('-p 8080:80');
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}
