# facebook-page-conversation-messages-reader


##This Util will featch your facebook messages and conversations from pages.

#####when it run first time, it will
-fetch all conversations in the page -> pagination applied
-create user for this page in db
-for each of fetched conversation it will all messages -> pagination applied
-create conversation in db
-create sender user in db
-save message in db and associate with users and conversations

#####after that, it will
-fetch only new conversations -> pagination applied
-check new messages -> pagination applied
-save message in db and associate with users and conversations