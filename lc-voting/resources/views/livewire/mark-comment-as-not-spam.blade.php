<x-modal-confirm
    {{--    eventToOpenModal="custom-show-delete-modal"--}}
    LiveWireeventToOpenModal="MarkCommentAsNotSpamWasSet"
    eventToCloseModal="commentWasMarkedAsNotSpam"
    modalTitle="Spam Comment"
    modalDescription="Are you sure you want to spam this Comment? this action can not be undo"
    modalConfirmButtonText="Not Spam"
    wireClick="markCommentAsNotSpam"
/>
