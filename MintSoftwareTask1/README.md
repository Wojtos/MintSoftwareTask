### Build project:
`cd [PROJECT_ROOT]/MintSoftwareTask1`\
`docker build -t mint-software-task-1 .` 
### Run project: 
`docker run -it --rm --name mint-software-task-1-running -v $(pwd)/resources:/usr/src/app/resources mint-software-task-1`\
The output will be visible in file resources/output.json
