const Swal = import('sweetalert2');

if (Alpine) {
  Alpine.data('languageSwitcher', (currentUrl, postId, postType, pageType, oldLang, selectedLanguage) => ({
    currentUrl: currentUrl,
    postId: postId,
    postType,
    pageType,
    oldLang,
    selectedLanguage,

    async changeLanguage(newLang) {
      try {
        const result = await this.sendLanguageChangeRequest(newLang, this.oldLang, this.currentUrl, this.postId, this.postType, this.pageType);
        if (
            result.type !== 'failed'
            && result.type !== 'Failed'
            && result.url !== ''
            && result.url !== undefined 
            && result.url !== null 
            && result.url !== 'undefined' 
            && result.url !== 'null' 
            && result.url !== 'false' 
            && result.url !== false 
            && result.url !== '0' 
            && result.url !== 0 
            && result.url !== 'NaN' 
            && result.url !== 'NaN') {
          window.location.href = result.url;
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: result.message,
            footer: result.footer,
            confirmButtonText: 'Ok',
            customClass: {
              confirmButton: '!bg-blue-50 focus:!ring-0 focus:!shadow-none !text-white px-3 py-1.5 rounded',
              title: 'h2',
              popup: 'border-2 border-gray-300'
            }
          });
        }
      } catch (error) { // JSAlert.alert(error.message);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: error.message,
          footer: '<a href="/en/contact/">Contact us</a>',
          confirmButtonText: 'Ok',
          customClass: {
            confirmButton: '!bg-blue-50 focus:!ring-0 focus:!shadow-none !text-white px-3 py-1.5 rounded',
            title: 'h2',
            popup: 'border-2 border-gray-300'
          }
        });
      }
    },

    sendLanguageChangeRequest(newLang, oldLang, currentUrl, postId, postType, pageType) {
      return new Promise((resolve, reject) => {
        jQuery.ajax({
          type: 'POST',
          url: wpml_ajax.ajaxurl,
          data: {
            action: 'change_current_language_page',
            payload: {
              newLang,
              oldLang,
              currentUrl,
              postId,
              postType,
              pageType
            }
          },
          beforeSend: () => {
            document.body.classList.add('loading-language');
          },
          success: response => {
            console.log(response)
            if (response.message === 'No change') {
              reject(response);
            } else {
              resolve(response);
            }
          },
          error: error => {
            console.log(error)
            reject(error);
          },
          complete: () => {
            document.body.classList.remove('loading-language');
          }
        });
      });
    }

  }));
}