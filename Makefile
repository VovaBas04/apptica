SHELL := /bin/bash
up:
	@./vendor/bin/sail up -d
	@./vendor/bin/sail artisan migrate
seed:
	@./vendor/bin/sail artisan app:get-data-command
run-dev:
	@./vendor/bin/sail artisan schedule:work
