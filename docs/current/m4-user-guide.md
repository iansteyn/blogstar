# COSC 360 M4 - User Guide

Site link: [cosc360.ok.ubc.ca/iansteyn](https://cosc360.ok.ubc.ca/iansteyn)

## **Unregistered User Walkthrough**

### **Browsing Home**

When a user accesses our website, they are brought to the home page, and can view a summary of all blog posts on the site which includes the post title, username of the user who made the post, the date the post was created, a summary of the text-body of the post, and the post image.

They can sort and view posts in the Recent tab or the Popular tab. The recent tab shows summaries of posts in order with the top post being the most recently posted and the last post being the oldest post. The popular tab lists the most liked posts with the top summary being the most liked and the bottom having less likes.

### **Viewing Specific Blog Posts**

To view a full blog post, the user can click on the image, title, or summary body text of any blog post summary. Users who are not signed in cannot view other user’s profiles, so clicking on a username will redirect the user to the Login page. Within a specific blog post, the user can additionally read comments left by other users, but the unregistered user is informed that they must be logged in if they would like to leave their own comments.

### **Searching**

The user can search for blog posts from both the search bar in the top right corner of the Home page or from the Search page using keywords to match parts of blog post titles. An empty query will return the full list of blog posts with recently posted blogs sorted first. Upon entering your search and hitting the magnifying glass or enter key, the user will be redirected to the search page with results closely matching the query string. Users can include more than one keyword at a time in their search, separated by spaces.

### **Login, Register, About**

General links in the side navigation that are accessible and visible to all users are the Login, Register, and About. The Login and Register pages both have reciprocal links to one another, suggesting to the user that they should access the Register page if they do not have an account, or the Login page if they do. The About page contains brief information about our website, including a short FAQ.

### **Side Navigation and Colour Theme Preferences**

Additional preference buttons on our site in the side navigation are the side navigation collapse/expand toggle, as well as the small pop up modal that allows users to switch their browser theme for the website from one of either their default browser mode, light mode, or dark mode.

## **Registered User Walkthrough**

The registered user maintains all of the same usability as the unregistered user but gains access to more features when registered and logged in. This includes access to all buttons for interacting with posts via liking and saving, viewing other user’s profiles, creating a post, creating comments, editing and deleting their posts and comments, and updating their profile.

When a user accesses the site they have restricted abilities to that of an unregistered user until they register or log in, both of which are always available if a user is not logged in.

### **Registering and Logging In/Out** Registering requires the following

- A username that must be 5-20 characters and only contain letters, numbers, and underscores and that is not already in use  
- A valid email address that is not already in use  
- A password that must be at least 8 characters and include an uppercase and lowercase letter, a number, and a special character  
- A matching confirming password  
- An profile picture in jpg, png, or gif format, and is less than 2mb (based on server limits)

Upon successfully registering, a user will be redirected to the Login page which requires the email and password the user registered with. This form includes the appropriate error handling if the email and/or password is incorrect.

Upon successfully logging in the user is redirected to the Home page. The Login and Register links will no longer be visible and are replaced with a functional logout button.  
The logout button provides an alert when clicked and users have the option to confirm or cancel. Confirming the logout will redirect the user to the Login page with limited access to the site, and contextual links in the side navigation bar update accordingly. 

### **Browsing Home**

When logged in, users will additionally see the Saved tab on the Home page. The saved tab is specific to the user and contains blog posts the user has decided to save.

Every post summary has a button to like the post and to save the post. These buttons do not link anywhere and act as a toggle. If the post belongs to you, you will also see 2 additional buttons for editing the post and a button for deleting the post. The button to edit links you to the editing page. The button to delete the post does not redirect, it instead creates a pop up asking you to confirm to delete the post. 

Clicking on the author's username of a blog post will link you to their page where you can see all the posts they have made.

### **Reading a Specific Post**

When clicking on a blog post summary the user will be redirected to the full post. Here you can see the blog’s entire content. The user still has access to the toggling save and like buttons. If the post belongs to the user they will also see the delete and edit buttons. The edit button functions as it did on home. The delete button will redirect to your profile, showing your other posts.

This page also has a comment section listing most recently made comments at the top. If a comment belongs to you, you are able to delete the comment with popup functionality being the same as for deleting a post.  
The user can post a comment or they can choose to discard it at which point they get up a popup to confirm the discarding the same as for deleting a post or comment.

There is also a new sidebar with the author's details since we are on their post and therefore on their page. This shows on their profile and their posts. When viewing your own profile or post you see your own details. Here you can see their username, profile picture and a bio if they have inputted one.

You also can see breadcrumbs leading back to the author’s page.

### **Viewing Someone Else’s Profile**

Clicking on an author's username for a specific blog post will route the user to the author’s profile. The profile has a tab for blog posts they have written and another tab for blog posts they have saved. Similar to on the home and search page, these posts can be liked and saved, as well as read in more detail. This is the same for viewing your own profile. The profile link in the side navigation bar is unhighlighted when viewing someone else's profile.

### **Viewing Your Own Profile**

When on your own profile you have 3 tabs. The profile button will be highlighted in the nav bar.  
Users gain the additional functionality of the edit and delete buttons on their own profile.   
If you have no posts created or no saved posts there will be a link taking the user to the create post section or the popular tab for the user to find posts to save. 

The Settings tab allows you to update your profile. Here you can change your password, update your profile picture and edit your bio. To change any of these parameters you have to correctly enter your current password. You are able to update these items independently from one another or all at once. 

### **Creating a Post**

By clicking the create button in the navbar you can access the page to create a post where you must enter a title, body and a photo to create a post. The create button will also be highlighted in nav. Users have the option to discard their post with a similar pop up as is used for discarding comments. Upon posting the blog the user is redirected back to their own profile where you can see the post has been added to their posts tab.

## **Admin User Walkthrough**

Our site has a single admin user with the following login credentials:  
**Email:** `sammie@example.com`  
**Password:** `123abcA.`

Upon logging in as the admin, the user is brought to the Admin Dashboard page, which is only accessible as the admin via the correct route in the browser search bar ([https://cosc360.ok.ubc.ca/iansteyn/?route=/admin](https://cosc360.ok.ubc.ca/iansteyn/?route=/admin)) or the contextual link in the side navigation bar. Attempting to access this page without the proper credentials will reroute the user to either the login page or a 403 forbidden page.

The admin has the same privileges of a registered user, but within the admin dashboard they can additionally:

- View and search or asynchronously filter the list of all registered users by username, including users who have not made blog posts.  
  - They can then view a user’s profile to see their profile picture and bio, posts they have created, as well as posts they have saved.  
- See site analytics for:  
  - User accounts: total users, registrations in the past week, and registrations today.  
  - Blog posts: total posts, posts created in the past week, and posts created today.  
  - Top 5 blog posts of all time by like count.

The admin is able to delete any post or comment made by other users. Posts can be deleted from within a specific blog post page, the home page, or when viewing a user’s profile.