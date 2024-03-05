class AccordionToggle {
  constructor(wrapper) {
    this.wrapper = wrapper
    this.init()
  }

  init() {
    this.closeOthers =
      this.wrapper.getAttribute('data-accordion-closeothers') === 'true'
    const toggleButtons = this.wrapper.querySelectorAll('button[aria-controls]')

    toggleButtons.forEach((button) => {
      button.addEventListener('click', () => {
        this.toggleSection(button)
      })
    })

    // Close all sections initially
    this.wrapper.querySelectorAll('[aria-target]').forEach((targetContent) => {
      targetContent.style.height = '0'
    })
  }

  closeOtherSections(currentButton) {
    if (this.closeOthers) {
      const toggleButtons = this.wrapper.querySelectorAll(
        'button[aria-controls]'
      )

      toggleButtons.forEach((otherButton) => {
        if (otherButton !== currentButton) {
          const otherTargetId = otherButton.getAttribute('aria-controls')
          const otherSection = otherButton.closest(
            `[data-accordion-section="${otherTargetId}"]`
          )
          this.closeSection(otherSection)
        }
      })
    }
  }

  closeSection(section) {
    const toggleButton = section.querySelector('button[aria-controls]')
    const targetId = toggleButton.getAttribute('aria-controls')
    const targetContent = section.querySelector(`[aria-target="${targetId}"]`)
    const classSwitchers = section.querySelectorAll('[open-classes]')

    if (targetContent) {
      targetContent.style.height = '0'
      toggleButton.setAttribute('aria-expanded', 'false')

      classSwitchers.forEach((switcher) => {
        const closeClasses = switcher.getAttribute('close-classes')
        const openClasses = switcher.getAttribute('open-classes')
        if (openClasses) {
          switcher.classList.remove(openClasses)
        }
        if (closeClasses) {
          switcher.classList.add(closeClasses)
        }
      })
      targetContent.setAttribute('aria-hidden', 'true')
    }
  }

  openSection(section) {
    const toggleButton = section.querySelector('button[aria-controls]')
    const targetId = toggleButton.getAttribute('aria-controls')
    const targetContent = section.querySelector(`[aria-target="${targetId}"]`)
    const classSwitchers = section.querySelectorAll('[open-classes]')

    if (targetContent) {
      targetContent.style.height = targetContent.scrollHeight + 'px'
      targetContent.setAttribute('aria-hidden', 'false')
      toggleButton.setAttribute('aria-expanded', 'true')

      classSwitchers.forEach((switcher) => {
        const openClasses = switcher.getAttribute('open-classes')
        const closeClasses = switcher.getAttribute('close-classes')
        if (openClasses) {
          switcher.classList.add(openClasses)
        }
        if (closeClasses) {
          switcher.classList.remove(closeClasses)
        }
      })
    }
  }

  toggleSection(button) {
    const targetId = button.getAttribute('aria-controls')
    const section = button.closest(`[data-accordion-section="${targetId}"]`)

    this.closeOtherSections(button)

    const targetContent = section.querySelector(`[aria-target="${targetId}"]`)

    if (targetContent) {
      const isOpen = targetContent.getAttribute('aria-hidden') === 'false'

      if (isOpen) {
        this.closeSection(section)
      } else {
        this.openSection(section)
      }
    }
  }
}

// Initialize the AccordionToggle class for each accordion wrapper
const accordionWrappers = document.querySelectorAll('[data-accordion-wrapper]')

accordionWrappers.forEach((wrapper) => {
  new AccordionToggle(wrapper)
})
