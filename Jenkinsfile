pipeline {
	agent any
	stages {

		stage('OWASP DependencyCheck') {
			steps {
				dependencyCheck additionalArguments: '--format HTML --format XML --suppression suppression.xml', odcInstallation: 'OWASP-Dependency-Check'
			}
		}
	}

	 stage('Integration UI Test') {
                        parallel {
                                stage('Deploy') {
                                        agent any
                                        steps {
                                                sh './jenkins/scripts/deploy.sh'
                                                input message: 'Finished using the web site? (Click "Proceed" to continue)'
                                                sh './jenkins/scripts/kill.sh'
                                        }
                                }
                                stage('Headless Browser Test') {
                                        agent {
                                                docker {
                                                        image 'maven:3-alpine' 
                                                        args '-v /root/.m2:/root/.m2' 
                                                }
                                        }
                                        steps {
                                                sh 'mvn -B -DskipTests clean package'
                                                sh 'mvn test'
                                        }
                                        post {
                                                always {
                                                        junit 'target/surefire-reports/*.xml'
                                                }
                                        }
                                }
                        }
                }

 stage('Code Quality Check via SonarQube') {
        steps {
          script {
            def scannerHome = tool 'SonarQube';
            withSonarQubeEnv('SonarQube') {
              sh 'ls ${scannerHome}'
              sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=OWASP -Dsonar.sources=."
            }
          }
        }
      }

	post {
		always {
      recordIssues enabledForFailure: true, tool: sonarQube()
    }
		success {
			dependencyCheckPublisher pattern: '**/dependency-check-report.xml'
		}
	}
}
