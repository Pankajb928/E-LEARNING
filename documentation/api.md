----------------list user----------------

curl --location 'http://127.0.0.1:8000/api/users/list_user' \
--header 'Content-Type: application/json' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImVtYWlsIjoiUGFua2FqYmhhdHQ5MjgyQGdtYWlsLmNvbSIsImlhdCI6MTcyMzczMDgyNiwiZXhwIjoxNzIzNzM0NDI2fQ.ZMipfykaGonxbZJHusbb-q23CPFTiTWZgg5YNkLjQ5E' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImVtYWlsIjoiUGFua2FqYmhhdHQ5MjgyQGdtYWlsLmNvbSIsImlhdCI6MTcyMzcyNTc2OCwiZXhwIjoxNzIzNzI5MzY4fQ.oiPjSx5RUuKh0q8UqwNDvY85jJRbdvJKal4LVe1uED8' \
--data ''

update user -----------

curl --location 'http://127.0.0.1:8000/api/users/update' \
--header 'Content-Type: application/json' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImVtYWlsIjoiUGFua2FqYmhhdHQ5MjgyQGdtYWlsLmNvbSIsImlhdCI6MTcyMzczMDgyNiwiZXhwIjoxNzIzNzM0NDI2fQ.ZMipfykaGonxbZJHusbb-q23CPFTiTWZgg5YNkLjQ5E' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImVtYWlsIjoiUGFua2FqYmhhdHQ5MjgyQGdtYWlsLmNvbSIsImlhdCI6MTcyMzcyNTc2OCwiZXhwIjoxNzIzNzI5MzY4fQ.oiPjSx5RUuKh0q8UqwNDvY85jJRbdvJKal4LVe1uED8' \
--data-raw '{
  "user_id" : 12,
  "name": "dhiraj",
  "email": "Pb99@gmail.com",
  "address": "Laluan Uttarakhand",
  "mobile_no": "7060602590"
}'

---create user ---

curl --location 'http://127.0.0.1:8000/api/users' \
--header 'Content-Type: application/json' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImVtYWlsIjoiUGFua2FqYmhhdHQ5MjgyQGdtYWlsLmNvbSIsImlhdCI6MTcyMzczMDgyNiwiZXhwIjoxNzIzNzM0NDI2fQ.ZMipfykaGonxbZJHusbb-q23CPFTiTWZgg5YNkLjQ5E' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImVtYWlsIjoiUGFua2FqYmhhdHQ5MjgyQGdtYWlsLmNvbSIsImlhdCI6MTcyMzcyNTc2OCwiZXhwIjoxNzIzNzI5MzY4fQ.oiPjSx5RUuKh0q8UqwNDvY85jJRbdvJKal4LVe1uED8' \
--data-raw '{
  "user_id" : 12,
  "name": "dhiraj",
  "email": "Pb@gmail.com",
  "address": "Laluan Uttarakhand",
  "mobile_no": "7060602589"
}'

----------Getting data from api

curl --location 'http://127.0.0.1:8000/api/users?user_id=10' \
--header 'Content-Type: application/json' \
--header 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImVtYWlsIjoiUGFua2FqYmhhdHQ5MjgyQGdtYWlsLmNvbSIsImlhdCI6MTcyMzczMDgyNiwiZXhwIjoxNzIzNzM0NDI2fQ.ZMipfykaGonxbZJHusbb-q23CPFTiTWZgg5YNkLjQ5E' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImVtYWlsIjoiUGFua2FqYmhhdHQ5MjgyQGdtYWlsLmNvbSIsImlhdCI6MTcyMzcyNTc2OCwiZXhwIjoxNzIzNzI5MzY4fQ.oiPjSx5RUuKh0q8UqwNDvY85jJRbdvJKal4LVe1uED8' \
--data-raw '{
  "user_id" : 12,
  "name": "dhiraj",
  "email": "Pankajbhatt9@gmail.com",
  "address": "Laluan Uttarakhand",
  "mobile_no": "7060602569"

}'

----login api

curl --location 'http://127.0.0.1:8000/api/v1/login' \
--header 'Content-Type: application/json' \
--data-raw '{

  "email": "Pankajbhatt9288@gmail.com",
  "password": "Admin@123"
}'