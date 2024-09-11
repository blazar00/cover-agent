# Makefile
SITE_PACKAGES=$(shell python -c "import wandb, os; print(os.path.dirname(wandb.__file__))")

.PHONY: test build installer

# Run unit tests with Pytest
test:
	poetry run pytest --junitxml=testLog.xml --cov=cover_agent --cov-report=xml:cobertura.xml --cov-report=term --cov-fail-under=65 --log-cli-level=INFO

# Use Python Black to format python files
format:
	black .

# Generate wheel file using poetry build command
build:
	poetry build

# Build an executable using Pyinstaller
installer:
	poetry run pyinstaller \
		--add-data "cover_agent/version.txt:." \
		--add-data "cover_agent/settings/language_extensions.toml:." \
		--add-data "cover_agent/settings/test_generation_prompt.toml:." \
		--add-data "cover_agent/settings/analyze_suite_test_headers_indentation.toml:." \
		--add-data "cover_agent/settings/analyze_suite_test_insert_line.toml:." \
		--add-data "$(SITE_PACKAGES)/vendor:wandb/vendor" \
		--hidden-import=tiktoken_ext.openai_public \
		--hidden-import=tiktoken_ext \
		--hidden-import=wandb \
		--hidden-import=wandb_gql \
		--onefile \
		--name cover-agent \
		cover_agent/main.py

local:
	rm -rf dist
	pip uninstall -y cover-agent
	poetry build
	pip install dist/cover_agent-0.0.0-py3-none-any.whl
	cover-agent \
		--source-file-path "templated_tests/python_fastapi/app.py" \
		--test-file-path "templated_tests/python_fastapi/test_app.py" \
		--code-coverage-report-path "templated_tests/python_fastapi/coverage.xml" \
		--test-command "pytest --cov=. --cov-report=xml --cov-report=term" \
		--test-command-dir "templated_tests/python_fastapi" \
		--coverage-type "cobertura" \
		--desired-coverage 100 \
		--max-iterations 1 \
		--mutation-testing \
		--more-mutation-logging