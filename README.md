# ProjectoAiNet

- Landing Page

- Product's List

- Product Detail

- Market Admin

- User Profile

- Advertisement Creating / Editing

- Trade Dashboard

- Participant Browsing

User Stories:

    Unauthenticated Users and all roles


    US1:

        - Access to Landing Page
        - Browse through produtcs based on filters (text, seller, location or tags), with custom order
        - Access to product details and related content from any product name
        - Access all products by a user from his detail page
        - View user accounts using filters, sortable and paged lists
        - Possibility of authentication with valid credentials
        - Possibility of register

        
    Administrator Role
    US2:
        Block product advertisement from detail page
        Block comments or replies from an advertisement detail
        Block a tag from a page detail (blacklist) so that it does not appear on any advertisement
        List blocked advertisements so that the administrator can restore each advertisement
        List blocked comments so that the administrator can restore each comment to their advertisement
        List blocked tags so that the administrator can restore them
        Be able to block an user from its detail page so that it becomes disabled
        List blocked users  so that it can restor each user's account
        List users so that I can assign or remove the Administrator role to each account
    Participant Role
    US3:
    As an authenticated user:
        Able to logout so that further access to the platform is made as an unauthenticated user
        Able to create a new product advertisement with all its data
        Able to edit or remove all data of a product advertisement
        Able to comment on a product advertisement
        Able to reply to a comment on a product advertisement
        Able to bid on a product that I do not own
        Able to list all bids on products that I own
        Accept or refuse a bid on a product that I own
        Able to evaluate the transaction of an accepted bid where I participate as a seller or a buyer
    Non functional requirements
        The web app must run on Homestead vagrant "box"
        Web client must comply with HTML5
