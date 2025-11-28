/**
 * Rupiah Formatter Helper
 * Auto format input nominal uang ke format Rupiah Indonesia
 */

// Format number to Rupiah format
export function formatRupiah(value) {
    if (!value) return '';
    
    // Remove non-digit characters
    const number = value.toString().replace(/[^0-9]/g, '');
    
    if (!number) return '';
    
    // Format with thousand separator
    return new Intl.NumberFormat('id-ID').format(number);
}

// Parse Rupiah format back to number
export function parseRupiah(value) {
    if (!value) return 0;
    return parseInt(value.toString().replace(/[^0-9]/g, '')) || 0;
}

// Initialize Rupiah formatter on input elements
export function initRupiahFormatter(selector = '[data-rupiah]') {
    document.querySelectorAll(selector).forEach(input => {
        // Format initial value
        if (input.value) {
            input.value = formatRupiah(input.value);
        }

        // Format on input
        input.addEventListener('input', function(e) {
            const cursorPosition = this.selectionStart;
            const oldLength = this.value.length;
            const oldValue = this.value;
            
            // Format the value
            const formatted = formatRupiah(this.value);
            this.value = formatted;
            
            // Adjust cursor position
            const newLength = formatted.length;
            const diff = newLength - oldLength;
            this.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
        });

        // Update Livewire model with clean number on blur
        input.addEventListener('blur', function() {
            const cleanValue = parseRupiah(this.value);
            
            // Trigger Livewire update if wire:model exists
            const wireModel = this.getAttribute('wire:model') || 
                            this.getAttribute('wire:model.live') ||
                            this.getAttribute('wire:model.blur');
            
            if (wireModel && window.Livewire) {
                // Get component
                const component = window.Livewire.find(
                    this.closest('[wire\\:id]')?.getAttribute('wire:id')
                );
                
                if (component) {
                    component.set(wireModel, cleanValue);
                }
            }
        });
    });
}

// Auto initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    initRupiahFormatter();
});

// Reinitialize after Livewire updates
document.addEventListener('livewire:init', () => {
    window.Livewire.hook('morph.updated', () => {
        initRupiahFormatter();
    });
});
