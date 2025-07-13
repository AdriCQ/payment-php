
DEFAULT_GOAL := help
help:
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z0-9_-]+:.*?##/ { printf "  \033[36m%-27s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

##@ [Macros] Make macros and aliases

.PHONY: format
format: pint

.PHONY: pint
pint: ## This will pint
	@echo 'Pint PHP files...'
	@exec ./vendor/bin/pint --dirty
