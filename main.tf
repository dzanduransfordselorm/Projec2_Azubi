# provider "aws"{
#     region = "us-east-1"
#     access_key = "AKIAVRUVWLVSV4ARIG5"
#     secret_key = "CHY65Ck5yS1d/IGBvixGfCHS99z5ZH8oQRR3uDEz"
# }

provider "aws" {

  region  = "us-east-1"
}

# Creating a table in dynamo DB
resource "aws_dynamodb_table" "SchoolScores" {
  name           = "StudentScore"
  read_capacity  = 10
  write_capacity = 10
  hash_key       = "StudentID"

  attribute {
    name = "StudentID"
    type = "N"
  }
}


# Adding items to the table
resource "aws_dynamodb_table_item" "SchoolScoresItems" {
  table_name = aws_dynamodb_table.SchoolScores.name
  hash_key   = aws_dynamodb_table.SchoolScores.hash_key

  item = <<ITEM
{
  "StudentID": {"N": "100100"},
  "Name": {"S": "Danny Olmo"},
  "Subject": {"S": "Mathematics"},
  "Score": {"N": "89"},
  "Class": {"N": "4"}
}
ITEM
}


resource "aws_dynamodb_table_item" "SchoolItem2" {
  table_name = aws_dynamodb_table.SchoolScores.name
  hash_key   = aws_dynamodb_table.SchoolScores.hash_key

  item = <<ITEM
{
  "StudentID": {"N":"22121"},
  "Name" : {"S": "Fred Amugi" },
  "Score" : {"N": "99"},
  "Subject": {"S": "Catering"}
  }
ITEM
}