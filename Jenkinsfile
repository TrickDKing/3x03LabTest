pipeline {
        agent any
        stages {
                stage ('Checkout') { 
            steps { 
                //git branch:'main', url: 'https://github.com/jerone-1997/jenkins-php-selenium-test.git' 
                checkout scm
            } 
        } 
                
               /* stage('OWASP DependencyCheck') {
			steps {
				dependencyCheck additionalArguments: '--format HTML --format XML --disableNodeJS --disableYarnAudit --nodeAuditSkipDevDependencies', odcInstallation: 'Default'
			}
      post {
        always {
           dependencyCheckPublisher pattern: 'dependency-check-report.xml'
        }
      }
		}*/
         
        /*stage('Code Quality Check via SonarQube') { 
                        steps { 
                                script { 
                                        def scannerHome = tool 'SonarQube'; 
                                        withSonarQubeEnv('SonarQube') { 
                                           sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=OWASP -Dsonar.sources=." 
                                        } 
                                } 
                        } 
        } 
		
		post { 
                always { 
                        recordIssues enabledForFailure: true, tool: sonarQube() 
                } 
    } */
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
    } 
        
}   
