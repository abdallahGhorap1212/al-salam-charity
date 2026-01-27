import './bootstrap';

const marquees = document.querySelectorAll('[data-marquee]');

marquees.forEach((marquee) => {
    const track = marquee.querySelector('[data-marquee-track]');
    const inner = marquee.querySelector('[data-marquee-inner]');
    if (!track || !inner) return;

    let offset = 0;
    let lastTime = 0;
    let speed = 0.04; // px per ms
    let gap = 24;
    let isPaused = false;
    let isDragging = false;
    let activePointerId = null;
    let startX = 0;
    let startOffset = 0;

    const getGap = () => {
        const styles = window.getComputedStyle(track);
        const rawGap = styles.columnGap || styles.gap || '0px';
        return parseFloat(rawGap) || 0;
    };

    const step = (time) => {
        if (!lastTime) lastTime = time;
        const delta = time - lastTime;
        lastTime = time;

        if (!isPaused) {
            offset -= speed * delta;
            inner.style.transform = `translateX(${offset}px)`;

            normalize();
        }

        requestAnimationFrame(step);
    };

    const normalize = () => {
        const marqueeRect = marquee.getBoundingClientRect();
        let first = track.firstElementChild;
        let last = track.lastElementChild;

        while (first) {
            const firstRect = first.getBoundingClientRect();
            if (firstRect.right >= marqueeRect.left) break;
            const shift = firstRect.width + gap;
            track.appendChild(first);
            offset += shift;
            inner.style.transform = `translateX(${offset}px)`;
            first = track.firstElementChild;
        }

        while (last) {
            const lastRect = last.getBoundingClientRect();
            if (lastRect.left <= marqueeRect.right) break;
            const shift = lastRect.width + gap;
            track.insertBefore(last, track.firstElementChild);
            offset -= shift;
            inner.style.transform = `translateX(${offset}px)`;
            last = track.lastElementChild;
        }
    };

    const onDragStart = (event) => {
        isDragging = true;
        isPaused = true;
        marquee.classList.add('is-dragging');
        activePointerId = event.pointerId;
        startX = event.clientX;
        startOffset = offset;
        marquee.setPointerCapture?.(event.pointerId);
    };

    const onDragMove = (event) => {
        if (!isDragging || event.pointerId !== activePointerId) return;
        event.preventDefault();
        const delta = event.clientX - startX;
        offset = startOffset + delta;
        inner.style.transform = `translateX(${offset}px)`;
        normalize();
    };

    const onDragEnd = () => {
        if (!isDragging) return;
        isDragging = false;
        isPaused = false;
        marquee.classList.remove('is-dragging');
        activePointerId = null;
    };

    marquee.addEventListener('pointerdown', (event) => {
        if ((event.pointerType === 'mouse' && event.button !== 0) || !event.isPrimary) return;
        if (event.pointerType === 'mouse' || event.pointerType === 'touch' || event.pointerType === 'pen') {
            onDragStart(event);
        }
    });
    window.addEventListener('pointermove', onDragMove);
    window.addEventListener('pointerup', onDragEnd);
    window.addEventListener('pointercancel', onDragEnd);

    marquee.addEventListener('mouseenter', () => {
        isPaused = true;
    });
    marquee.addEventListener('mouseleave', () => {
        isPaused = false;
    });
    marquee.addEventListener('focusin', () => {
        isPaused = true;
    });
    marquee.addEventListener('focusout', () => {
        isPaused = false;
    });

    const setup = () => {
        gap = getGap();
        offset = 0;
        inner.style.transform = 'translateX(0)';
    };

    window.addEventListener('resize', setup);
    setup();
    requestAnimationFrame(step);
});

// Pagination handled server-side on the news page.

const wysiwygs = document.querySelectorAll('[data-wysiwyg]');

wysiwygs.forEach((wrapper) => {
    const editor = wrapper.querySelector('[data-wysiwyg-editor]');
    const input = wrapper.querySelector('[data-wysiwyg-input]');
    const buttons = wrapper.querySelectorAll('[data-command]');

    if (!editor || !input) return;

    editor.innerHTML = input.value || '';

    const sync = () => {
        input.value = editor.innerHTML;
    };

    editor.addEventListener('input', sync);
    editor.addEventListener('blur', sync);

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const command = button.getAttribute('data-command');
            if (!command) return;

            editor.focus();

            if (command === 'link') {
                const url = window.prompt('ادخل الرابط');
                if (url) {
                    document.execCommand('createLink', false, url);
                }
                return;
            }

            if (command === 'h2' || command === 'h3') {
                document.execCommand('formatBlock', false, command.toUpperCase());
                return;
            }

            if (command === 'p') {
                document.execCommand('formatBlock', false, 'P');
                return;
            }

            if (command === 'ul') {
                document.execCommand('insertUnorderedList');
                return;
            }

            if (command === 'ol') {
                document.execCommand('insertOrderedList');
                return;
            }

            document.execCommand(command);
        });
    });

    const form = wrapper.closest('form');
    if (form) {
        form.addEventListener('submit', sync);
    }
});
