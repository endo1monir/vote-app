<x-modal-confirm
    {{--    eventToOpenModal="custom-show-delete-modal"--}}
    LiveWireeventToOpenModal="MarkCommentAsSpamWasSet"
    eventToCloseModal="commentWasMarkedAsSpam"
    modalTitle="Spam Comment"
    modalDescription="Are you sure you want to spam this Comment? this action can not be undo"
    modalConfirmButtonText="Spam"
    wireClick="SpamComment"
/>
