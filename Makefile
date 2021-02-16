deploy-staging:
	ansible-playbook ./deploy/staging-apps.yml --vault-id=./deploy/pass
