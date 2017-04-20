serve:
	@echo "\033[32;49mServer listening on http://127.0.0.1:8000\033[39m"
	@echo "Quit the server with CTRL-C."
	php -S 127.0.0.1:8000 -t web
.PHONY: serve
